<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    /**
     * @var Category
     */
    protected $categories;

    /**
     * @param Category $categories
     */
    public function __construct(Category $categories)
    {
        parent::__construct();

        $this->categories = $categories;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->all();
        return view('layouts.admin.categories', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $types = [];
        foreach (Type::all() as $catType) {
            $types[$catType->getAttribute('id')] = $catType->getAttribute('description');
        }
        return view('layouts.admin.category-form', compact('category', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreCategoryRequest $request)
    {
        $this->categories->create($request->all());
        return redirect(route('categories.index'))->with('message', 'Запись добавлена в базу данных');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categories->findOrFail($id);
        $types = [];
        foreach (Type::all() as $catType) {
            $types[$catType->getAttribute('id')] = $catType->getAttribute('description');
        }
        return view('layouts.admin.category-form', compact('category', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateCategoryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateCategoryRequest $request, $id)
    {
        $category = $this->categories->findOrFail($id);
        $category->update($request->all());
        return redirect(route('categories.index'))->with('message', 'Запись успешно обновлена');

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
        $category = $this->categories->findOrFail($id);

        if ($request->ajax()) {
            $category->delete($request->all());
            return response(['msg' => 'Категория удалена', 'status' => 'success']);
        }
        return response(['msg' => 'Не удалось удалить категорию', 'status' => 'failed']);
    }

}
