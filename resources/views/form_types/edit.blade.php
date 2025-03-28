@extends('layouts.app')

@section('content')
<h2>Редактировать тип формы</h2>
<form method="POST" action="{{ route('form_types.update', $formType->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="type" class="form-label">Название типа</label>
        <input type="text" class="form-control" name="type" id="type" value="{{ $formType->type }}" required>
    </div>
    <div class="mb-3">
        <label for="addionals" class="form-label">JSON-конфигурация (addionals)</label>
        <textarea class="form-control" name="addionals" id="addionals" rows="5">@if($formType->addionals){{ json_encode($formType->addionals) }}@endif</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
@endsection
