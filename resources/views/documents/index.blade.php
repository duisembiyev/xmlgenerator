@extends('layouts.app')

@section('content')
<h2>Мои документы</h2>
<a href="{{ route('documents.create') }}" class="btn btn-success mb-2">Создать новый документ</a>
<a href="{{ route('documents.generate') }}" class="btn btn-primary mb-2">Сгенерировать все документы</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Тип</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
    @foreach($documents as $doc)
        <tr>
            <td>{{ $doc->id }}</td>
            <td>{{ $doc->type }}</td>
            <td>{{ $doc->created_at }}</td>
            <td>
                <a href="{{ route('documents.edit', $doc->id) }}" class="btn btn-primary btn-sm">Редактировать</a>
                <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Удалить документ?')">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
