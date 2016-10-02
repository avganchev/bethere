@extends('layouts.app')

@section('contentheader_title', 'События')
@section('htmlheader_title', 'События')

@section('main-content')

    <div class="spark-screen">
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="callout callout-info">{{ Session::get('message') }}</div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">События</div>


            <div class="panel-body">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Добавить</a>
                <table class="table table-hover">
                    <colgroup>
                        <col width="120">
                        <col>
                        <col>
                        <col width="100">
                    </colgroup>
                    <thead>
                    <tr>
                        <td></td>
                        <td>Заголовок</td>
                        <td>Ссылка</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($posts->isEmpty())
                        <tr>
                            <td colspan="5" align="center">Нет событий</td>
                        </tr>
                    @else
                        @foreach($posts as $post)
                            <tr>
                                <td><img src="{{  url($post->image) }}" width="100"></td>
                                <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                                <td><a href="{{ url($post->uri) }}">{{ '/' . ltrim($post->uri, '/') }}</a></td>
                                <td>
                                    <div id="deleteEntry" class="btn-group" style="width: 100%">
                                        <a class="btn btn-link" href="{{ route('posts.edit', $post->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                        {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteEntry', 'action' => ['Backend\PostController@destroy', $post->id]]) !!}
                                        {!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'deleteEntry btn btn-link', 'data-action' => route('posts.destroy', $post->id) ] ) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection