@extends('layouts.app')

@section('content')
<h2>Мои документы</h2>
<a href="{{ route('documents.create') }}" class="btn btn-success mb-2">Создать новый документ</a>
<!--<a href="{{ route('documents.generate') }}" class="btn btn-primary mb-2">Сгенерировать все документы</a>!-->

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
                <!--<a href="{{ route('documents.edit', $doc->id) }}" class="btn btn-primary btn-sm">Редактировать</a>!-->
                <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Удалить документ?')">Удалить</button>
                </form>
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#docModal{{ $doc->id }}">Посмотреть</button>
                <a href="{{ route('documents.view', $doc->id) }}" class="btn btn-success btn-sm" download>Скачать</a>

                <div class="modal fade" id="docModal{{ $doc->id }}" tabindex="-1" aria-labelledby="docModalLabel{{ $doc->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="docModalLabel{{ $doc->id }}">Содержимое документа #{{ $doc->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{ route('documents.view', $doc->id) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
