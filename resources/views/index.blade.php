@extends('layout')

@section('body')
<div class="flex-center position-ref full-height">
    <div class="top-right links">
        <a href="{{ route('login') }}">Login</a>
        {{-- <a href="{{ route('home.new') }}">Enregistrer un migrant</a> --}}
    </div>

    <div class="content">
        <div class="title m-b-md">
            Welcome To Food Bank App ... 
        </div>
    </div>
</div>
@endsection
