@extends('layouts.admin')

@section('content')
<div class="card-body text-center">
	<img src="data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(300)->merge("\public\img\angular.png",0.2)->errorCorrection("H")->generate($code)) !!}">
</div>
@endsection