@extends('layouts.app')

@section('content')
<h2>Типы форм</h2>
<a href="{{ route('form_types.create') }}" class="btn btn-success mb-2">Создать новый тип</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Тип</th>
            <th>Дата создания</th>
            <th>Кем создан</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
    @foreach($formTypes as $ft)
        <tr>
            <td>{{ $ft->id }}</td>
            <td>{{ $ft->type }}</td>
            <td>{{ $ft->created_at }}</td>
            <td>{{ $ft->created_by }}</td>
            <td>
                <a href="{{ route('form_types.edit', $ft->id) }}" class="btn btn-primary btn-sm">Редактировать</a>
                <form action="{{ route('form_types.destroy', $ft->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Удалить тип формы?')">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
