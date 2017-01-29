@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Вход</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="login" class="col-md-4 control-label">Логин</label>
                <div class="col-md-4">
                  <input id="login" type="text" class="form-control" name="login" required autofocus>
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-4 control-label">Пароль</label>
                <div class="col-md-4">
                  <input id="password" type="password" class="form-control" name="password" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <button type="submit" class="btn btn-primary">
                    Войти
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection