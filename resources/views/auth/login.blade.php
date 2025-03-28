@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-6 offset-md-3">
    <h2>Вход</h2>
    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="text" class="form-control" name="login" id="login" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Войти</button>
      <a href="{{ route('register') }}" class="btn btn-link">Регистрация</a>
    </form>
  </div>
</div>
@endsection
