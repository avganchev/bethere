@extends('layouts.app')

@section('contentheader_title', 'Категории')
@section('htmlheader_title', $category->exists ? 'Editing ' . $category->title : 'Новая категория')
@section('main-content')
    <div class="spark-screen">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $category->exists ? 'Редактирование ' . $category->title : 'Новая категория' }}</h2>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($category, [
                'route' => $category->exists ? ['categories.update', $category->id] : ['categories.store'],
                'method' => $category->exists ? 'PUT' : 'POST',
                'files' => true
            ]) !!}

            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name', 'Название') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Описание') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type_id', 'Тип') !!}
                    <div class="input-group">
                        {!! Form::select('type_id', $types, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="box-footer">
                {!! Form::submit($category->exists ? 'Сохранить' : 'Добавить', ['class' => 'btn btn-primary']) !!}
                @if( $category->exists )
                    {!! Form::submit('Отмена', [
                    'onclick' => 'window.location="' . route('categories.index'). '";return false;',
                    'class' => 'btn btn-warning'
                    ]) !!}
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('post-scripts')
    <!-- Summernote editor -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script>
        $(document).ready(function () {
            $('#description').summernote({
                height: 150
            });
        });
    </script>
@endsection