@extends('layouts.app')

@section('content')
<h2>Генерация (MainForm)</h2>
<style>
    .compact-form .form-group {
        display: inline-block;
        margin-right: 10px;
        width: 30%;
        vertical-align: top;
    }
    .compact-form label {
        display: block;
    }
</style>

<form method="POST" action="{{ route('documents.store') }}" class="compact-form">
    @csrf
    <input type="hidden" name="form_type_id" value="{{ $formType->id }}">
    
    <div id="dynamicFields">
        @foreach($formType->addionals['fields'] as $field)
            <div class="form-group mb-2">
                <label for="{{ $field['name'] }}">{{ $field['label'] ?? $field['name'] }}</label>
                <input type="{{ $field['type'] ?? 'text' }}" class="form-control" name="{{ $field['name'] }}" id="{{ $field['name'] }}">
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-success mt-3">Сохранить документ</button>
</form>
@endsection
