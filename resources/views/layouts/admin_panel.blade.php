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

  @yield('navbar')

  <div class="container-fluid text-center">
    {{-- ERRORS --}}
    @if (count($errors) > 0)
        <ul>
          @foreach ($errors->all() as $error)
            <div class="alert alert-warning">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ $error }}
            </div>
          @endforeach
        </ul>
    @endif

    {{-- FLASH MESSAGES --}}
    <div style="height: 60px">
    @if (session()->has('flash_notification.message'))
      <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('flash_notification.message') }}
      </div>
    @endif
    </div>
    @yield('content')
  </div>
</body>
</html>