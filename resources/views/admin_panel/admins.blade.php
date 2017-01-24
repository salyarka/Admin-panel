@extends('layouts.admin_panel')

@section('content')
{{-- EXAMPLE --}}
{{-- <div class="col-md-4">
    <div class="card">
        <div class="header">
            <h4 class="title">Email Statistics</h4>
            <p class="category">Last Campaign Performance</p>
        </div>
        <div class="content">
            <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
            <div class="footer">
                <div class="legend">
                    <i class="fa fa-circle text-info"></i> Open
                    <i class="fa fa-circle text-danger"></i> Bounce
                    <i class="fa fa-circle text-warning"></i> Unsubscribe
                </div>                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                </div>
            </div>
        </div>
    </div>
</div> --}}

  <div class="card">
    <div class="header">
      <h3>Администраторы</h3>
    </div>
    {{-- ADD ADMIN --}}
    <div class="col-sm-3 sidenav">
      <div class="card">
        <div class="panel-heading">Добавление нового администратора</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admins') }}">
              {{ csrf_field() }}
              {{-- LOGIN  --}}
              <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                <label for="login" class="col-md-4 control-label">Логин</label>
                <div class="col-md-6">
                  <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" required autofocus>
                  @if ($errors->has('login'))
                    <span class="help-block">
                      <strong>{{ $errors->first('login') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              {{-- SURNAME --}}
              <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                <label for="surname" class="col-md-4 control-label">Фамилия</label>
                <div class="col-md-6">
                  <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>
                  @if ($errors->has('surname'))
                    <span class="help-block">
                      <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              {{-- NAME --}}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Имя</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                  @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              {{-- PASSWORD --}}
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Пароль</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" required>
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              {{-- CONFIRM --}}
              <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Подтверждение пароля</label>
                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>
              {{-- SUBMIT --}}
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Создать
                  </button>
                </div>
              </div>
                
            </form>
          </div>
        </div>
      </div>
    </div> {{-- ADD ADMIN --}}
    {{-- SHOW ADMINS --}}
    <div class="col-sm-9">
      <table class="table text-left">
        <thead>
          <tr>
            <th>Логин</th>
            <th>Фамилия</th>
            <th>Имя</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($admins as $admin)
            @if ($admin->role == 'admin')
              <tr>
                <td>{{ $admin->login }}</td>
                <td>{{ $admin->surname }}</td>
                <td>{{ $admin->name }}</td>
                {{-- EDIT --}}
                <td>
                  <button class="btn btn-info" data-toggle="modal" data-target="#{{ $admin->id }}">
                    Изменить
                  </button>
                  <div class="modal fade" id="{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Админ</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('/admins/' . $admin->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            {{-- LOGIN --}}
                            <div class="form-group">
                              <label for="new_login">Логин</label>
                              <input type="text" class="form-control" name="new_login" value="{{ $admin->login }}">
                            </div>
                            {{-- NAME --}}
                            <div class="form-group">
                              <label for="new_name">Имя</label>
                              <input type="text" class="form-control" name="new_name" value="{{ $admin->name }}">
                            </div>
                            {{-- SURNAME --}}
                            <div class="form-group">
                              <label for="new_surname">Фамилия</label>
                              <input type="text" class="form-control" name="new_surname" value="{{ $admin->surname }}">
                            </div>
                            {{-- NEW PASSWORD --}}
                            <div>
                              <label for="new_password">Новый пароль</label>
                              <input type="password" class="form-control" name="new_password">
                            </div>
                            <br>
                            {{-- CONFIRM --}}
                            <div>
                              <label for="new_password_confirm">Подтверждение</label>
                              <input type="password" class="form-control" name="new_password_confirmation">
                            </div>  
                            <br>  
                            <button type="submit" class="btn btn-warning">Изменить и закрыть</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td> {{-- EDIT --}}
                {{-- DELETE --}}
                <td>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#del{{ $admin->id }}">
                    Удалить
                  </button>
                  <div class="modal fade" id="del{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Подтверждение удаления</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('/admins/' . $admin->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                              <h5>Вы точно хотите удалить админстратора {{ $admin->login }} ?</h5>
                            </div>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td> {{-- DELETE --}}
              </tr> 
            @endif
          @endforeach
        </tbody>
      </table>
    </div> {{-- SHOW ADMINS --}}
  </div>
@endsection