@extends('layouts.default')

@section('content')
    <div class="jumbotron">
        <h1>Hello Mdvtrw</h1>
        <p class="lead">
            你现在所看到的是 <a href="https://fsdhub.com/books/laravel-essential-training-5.1">Mdvtrw </a> 个人博客中心
        </p>
        <p>
            一切，将从这里开始。
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{ route('users.create') }}" role="button">现在注册</a>
        </p>
    </div>
@stop