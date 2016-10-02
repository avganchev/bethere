<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    /**
     * @var Post
     */
    protected $posts;

    /**
     * @var array
     */
    protected $categories = [];

    /**
     * @param Post $posts
     */
    public function __construct(Post $posts)
    {
        parent::__construct();

        $this->posts = $posts;
        foreach (Category::all() as $cat) {
            $this->categories[$cat->type->name][$cat->getAttribute('id')] = $cat->getAttribute('name');
        }
        // $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->posts->all();
        return view('layouts.admin.posts', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $categories = $this->categories;
        return view('layouts.admin.event-form', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePostRequest $request)
    {
        $fields = $request->except('category');
        $fields['user_id'] = Auth::user()->id;
        $fields['uri'] = Str::slug($request->get('title'));
        $fields['type'] = Post::TYPE_EVENT;
        $fields['status'] = Post::STATUS_MODERATE;

        if (!empty($fields['end_date'])) {
            $endDate = Carbon::createFromFormat('m/d/Y', $fields['end_date']);
            $startDate = Carbon::createFromFormat('m/d/Y', $fields['start_date']);
            if ($startDate->getTimestamp() > $endDate->getTimestamp()) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors(['Конец события не может быть раньше его начала']);
            }
        }

        # processing image file
        $image = Input::file('image');
        $filename = date('Y-m-d-His') . '-' . $image->getClientOriginalName();
        Image::make($image->getRealPath())
            ->widen(800, function ($constraint) {
                $constraint->upsize();
            })
            ->save(public_path('img/posts/' . $filename));

        $fields['image'] = 'img/posts/' . $filename;
        $this->posts->fill($fields);
        $this->posts->setPriceAttribute($request->get('price'));
        auth()->user()->posts()->save($this->posts);

        # save category
        $this->posts->category()->sync(array_values($request->input('category')), false);

        return redirect(route('posts.index'))->with('message', 'Запись добавлена в базу данных');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->posts->findOrFail($id);
        $categories = $this->categories;

        return view('layouts.admin.event-show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->posts->findOrFail($id);
        $categories = $this->categories;

        return view('layouts.admin.event-form', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdatePostRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePostRequest $request, $id)
    {
        $post = $this->posts->findOrFail($id);

        $fields = $request->except('category');
        $fields['user_id'] = Auth::user()->id;
        $fields['uri'] = Str::slug($request->get('title'));
        $fields['type'] = Post::TYPE_EVENT;
        $fields['status'] = Post::STATUS_MODERATE;

        if (!empty($fields['end_date'])) {
            $endDate = Carbon::createFromFormat('m/d/Y', $fields['end_date']);
            $startDate = Carbon::createFromFormat('m/d/Y', $fields['start_date']);
            if ($startDate->getTimestamp() > $endDate->getTimestamp()) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors(['Конец события не может быть раньше его начала']);
            }
        }

        # processing image file
        $image = Input::file('image');
        if ($image !== null) {
            # delete old image
            if ($post->image) {
                $file = $post->image;
                if (\File::isFile($file)) {
                    \File::delete($file);
                }
            }
            # save new image
            $filename = date('Y-m-d-His') . '-' . $image->getClientOriginalName();
            Image::make($image->getRealPath())->widen(800, function ($constraint) {
                $constraint->upsize();
            })->save(public_path('img/posts/' . $filename));
            $fields['image'] = 'img/posts/' . $filename;
        }
        $post->fill($fields);
        $post->setPriceAttribute($request->get('price'));
        $post->e_online = isset($request['e_online']);
        $post->e_free = isset($request['e_free']);
        auth()->user()->posts()->save($post);

        # save category
        $post->category()->sync(array_values($request->input('category')), false);

        return redirect(route('posts.index'))->with('message', 'Запись успешно обновлена');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $post = $this->posts->findOrFail($id);

        if ($request->ajax()) {
            # delete related categories
            $post->category()->detach();
            # delete post
            $post->delete($request->all());
            return response(['msg' => 'Событие удалено', 'status' => 'success']);
        }
        return response(['msg' => 'Не удалось удалить событие', 'status' => 'failed']);
    }

}
