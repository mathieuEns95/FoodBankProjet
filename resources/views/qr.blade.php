@extends('layout')

@section('body')
<div class="flex-center position-ref full-height">
    <div class="top-right links">
        <a href="{{ route('home.new') }}">Enregistrer un migrant</a>
    </div>  

    <div class="content">
    	<iframe src="{{ $url }}" width="400" height="400"></iframe>
    </div>
</div>
@endsection