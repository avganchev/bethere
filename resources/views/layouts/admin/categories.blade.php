@extends('layouts.app')

@section('contentheader_title')
    Категории
@endsection
@section('htmlheader_title')
    Категории
@endsection


@section('main-content')
    <div class="spark-screen">
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="callout callout-info">{{ Session::get('message') }}</div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">Категории</div>

            <div class="panel-body">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Добавить категорию</a>
                <table class="table table-hover">
                    <colgroup>
                        <col>
                        <col>
                        <col>
                        <col width="100">
                    </colgroup>
                    <thead>
                    <tr>
                        <td>Название</td>
                        <td>Тип</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($categories->isEmpty())
                        <tr>
                            <td colspan="4" align="center">Нет категорий</td>
                        </tr>
                    @else
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->type->description }}</td>
                                <td>
                                    <div id="deleteEntry" class="btn-group" style="width: 100%">
                                        <a class="btn btn-link" href="{{ route('categories.edit', $category->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                        {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteEntry', 'action' => ['Backend\CategoryController@destroy', $category->id]]) !!}
                                        {!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'deleteEntry btn btn-link', 'data-action' => route('categories.destroy', $category->id) ] ) !!}
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