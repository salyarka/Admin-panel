<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Управление: @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          @if (Auth::user()->role == 'superAdmin')
            <li><a href="{{ url('/admin')}}">Админы</a></li>
          @endif
          <li><a href="{{ url('/admin/faq')}}">Темы</a></li>
          <li><a href="{{ url('/admin/unanswered')}}">Вопросы без ответов</a></li>          
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ url('/logout')}}"><span class="glyphicon glyphicon-log-in"></span> Выход</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid text-center">
    {{-- ERRORS --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <div class="alert alert-warning">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ $error }}
            </div>
          @endforeach
        </ul>
      </div>
    @endif
    {{-- FLASH MESSAGES --}}
    @if (session()->has('flash_notification.message'))
      <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('flash_notification.message') }}
      </div>
    @endif
    @yield('content')
  </div>
</body>
</html>