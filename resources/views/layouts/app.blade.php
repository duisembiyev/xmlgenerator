<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Microservice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .min-vh-100 {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content-flex {
            flex: 1;
        }
        .no-top-margin {
            margin-top: 0 !important;
        }
    </style>
</head>
<body>
<div class="min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Microservice</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        @auth
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('documents.create') }}">Генерация</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('documents.index') }}">Мои документы</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('settings') }}">Настройки</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('form_types.index') }}">Типы форм</a>
              </li>
            </ul>
            <form class="d-flex" method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-light" type="submit">Выйти</button>
            </form>
          </div>
        @endauth
      </div>
    </nav>

    <div class="container-fluid content-flex no-top-margin">
        @if(session('success'))
          <div class="alert alert-success mt-2">
              {{ session('success') }}
          </div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger mt-2">
              <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-light text-center py-3">
        <p class="mb-0">© 2025 Microservice Footer</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
