@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center text-center" style="height:100%;">
    <h1 class="display-4">Добро пожаловать, {{ Auth::user()->full_name ?? 'Гость' }}!</h1>
    <p class="lead">Это главная страница микросервиса.</p>
    <hr class="my-4 w-100" />
    <img src="https://picsum.photos/1920/600" alt="Random" class="img-fluid" style="max-height: 70vh; object-fit: cover;">
</div>
@endsection
