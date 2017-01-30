@extends('layouts.app')

@section('title', 'администраторами')

@section('navbar')
  @include('dashboard.components.navbar')
@endsection

@section('content')
  <div class="card">
  
    {{-- ADD ADMIN --}}
    <div class="col-sm-3 sidenav">
      <div class="card">
        <div class="panel-heading">Добавление нового администратора</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin') }}">
              {{ csrf_field() }}

              {{-- LOGIN  --}}
              <div class="form-group">
                <label for="login" class="col-md-4 control-label">Логин</label>
                <div class="col-md-6">
                  <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" required autofocus>
                </div>
              </div>

              {{-- SURNAME --}}
              <div class="form-group">
                <label for="surname" class="col-md-4 control-label">Фамилия</label>
                <div class="col-md-6">
                  <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>
                  @if ($errors->has('surname'))
                  @endif
                </div>
              </div>

              {{-- NAME --}}
              <div class="form-group">
                <label for="name" class="col-md-4 control-label">Имя</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>
              </div>

              {{-- PASSWORD --}}
              <div class="form-group">
                <label for="password" class="col-md-4 control-label">Пароль</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" required>
                </div>
              </div>

              {{-- CONFIRM --}}
              <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Подтвердите</label>
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
      @if (count($admins) > 1)
        <div class="header">
          <h3>Администраторы</h3>
        </div> 
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
                            <form action="{{ url('/admin/' . $admin->id) }}" method="POST">
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
                              <div class="form-group">
                                <label for="new_password">Новый пароль</label>
                                <input type="password" class="form-control" name="new_password">
                              </div>

                              {{-- CONFIRM --}}
                              <div class="form-group">
                                <label for="new_password_confirm">Подтверждение</label>
                                <input type="password" class="form-control" name="new_password_confirmation">
                              </div> 

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
                            <form action="{{ url('/admin/' . $admin->id) }}" method="POST">
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
      @else
        <h3>Пока что нет администраторов</h3>  
      @endif
    </div> {{-- SHOW ADMINS --}}
  </div>
@endsection