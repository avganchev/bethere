@extends('layouts.app')

@section('contentheader_title', 'События')
@section('htmlheader_title', $post->title)

@section('main-content')
    <div class="spark-screen">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $post->title }}</div>

            <img src="{{ url($post->image) }}" align="center">
            <br/>
            {!! $post->description !!}
            <p><span>Дата начала: </span>{{ $post->start_date }}</p>
            <p><span>Время начала: </span>{{ $post->start_time }}</p>
        </div>
    </div>

@endsection