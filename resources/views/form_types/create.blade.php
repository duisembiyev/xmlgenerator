@extends('layouts.app')

@section('content')
<h2>Создать новый тип формы</h2>
<form method="POST" action="{{ route('form_types.store') }}">
    @csrf
    <div class="mb-3">
        <label for="type" class="form-label">Название типа</label>
        <input type="text" class="form-control" name="type" id="type" required>
    </div>
    <div class="mb-3">
        <label for="addionals" class="form-label">JSON-конфигурация (addionals)</label>
        <textarea class="form-control" name="addionals" id="addionals" rows="5"></textarea>
        <small class="text-muted">Например: {"fields":[{"name":"field1","label":"Поле 1"}]}</small>
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
@endsection
