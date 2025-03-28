@extends('layouts.app')

@section('content')
<h2>Настройки</h2>
<div class="row">
  <div class="col-md-6">
    <h4>Смена пароля</h4>
    <form action="{{ route('settings.password') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="old_password" class="form-label">Старый пароль</label>
        <input type="password" class="form-control" name="old_password" id="old_password">
      </div>
      <div class="mb-3">
        <label for="new_password" class="form-label">Новый пароль</label>
        <input type="password" class="form-control" name="new_password" id="new_password">
      </div>
      <button type="submit" class="btn btn-primary">Обновить пароль</button>
    </form>
  </div>

  <div class="col-md-6">
    <h4>Загрузка аватара</h4>
    <form action="{{ route('settings.avatar') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="avatar" class="form-label">Аватар</label>
        <input type="file" class="form-control" name="avatar" id="avatar">
      </div>
      <button type="submit" class="btn btn-primary">Загрузить</button>
    </form>
    @if($user->avatar)
      <div class="mt-3">
        <img src="{{ asset($user->avatar) }}" alt="Avatar" width="100">
      </div>
    @endif
  </div>
</div>
@endsection
