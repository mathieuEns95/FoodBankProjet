@extends('layout')

@section('body')
<div class="flex-center position-ref full-height">
    <div class="top-right links">
        <a href="{{ route('home.new') }}">Enregistrer un migrant</a>
    </div>  

    <div class="content">
        <div class="title m-b-md">
            Welcome To Our Beautiful App ...
        </div>

        <div class="links">
            <a target="_blank"rel="noopener" href="https://laravel.com/docs">Documentation</a>
            <a target="_blank"rel="noopener" href="https://laracasts.com">Laracasts</a>
            <a target="_blank"rel="noopener" href="https://laravel-news.com">News</a>
            <a target="_blank"rel="noopener" href="https://nova.laravel.com">Nova</a>
            <a target="_blank"rel="noopener" href="https://forge.laravel.com">Forge</a>
            <a target="_blank"rel="noopener" href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
</div>
@endsection