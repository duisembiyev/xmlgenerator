@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-6 offset-md-3">
    <h2>Регистрация</h2>
    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <div class="mb-3">
        <label for="full_name" class="form-label">Полное имя</label>
        <input type="text" class="form-control" name="full_name" id="full_name" required>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Имя (короткое)</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="text" class="form-control" name="login" id="login" required>
      </div>
      <div class="mb-3">
        <label for="phone_number" class="form-label">Телефон</label>
        <input type="text" class="form-control" name="phone_number" id="phone_number">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
  </div>
</div>
@endsection
