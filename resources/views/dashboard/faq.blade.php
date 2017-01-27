@extends('layouts.admin_panel')

@section('title', 'темами')

@section('content')
  <div class="card">
    <div class="header">
      <h3>Темы</h3>
    </div>

    {{-- ADD TOPIC --}}
    <div class="col-sm-3 sidenav">
      <div class="card">
        <div class="panel-heading">Добавление новой темы</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/faq') }}">
              {{ csrf_field() }}

              {{-- TITLE  --}}
              <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">Название</label>
                <div class="col-md-6">
                  <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                  @if ($errors->has('title'))
                    <span class="help-block">
                      <strong>{{ $errors->first('title') }}</strong>
                    </span>
                  @endif
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
    </div>

    {{-- SHOW TOPICS --}}
    <div class="col-sm-9">
      <table class="table text-left">
        <thead>
          <tr>
            <th>Название</th>
            <th>Всего</th>
            <th>Опубликовано</th>
            <th>Без ответов</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($topics as $topic)
            <tr>
              <td>
                <div>
                  <a href="{{ url('admin/faq/topic/' . $topic->id) }}">{{ $topic->title }}</a>                  
                </div>
              </td>
              <td>{{ $topic->totalQuestions() }}</td>
              <td>{{ $topic->publishedQuestions() }}</td>
              <td>{{ $topic->noAnswerQuestions() }}</td>

              {{-- EDIT --}}
              <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#{{ $topic->id }}">
                    Изменить
                  </button>
                  <div class="modal fade" id="{{ $topic->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Изменение темы {{ $topic->title }}</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('/admin/faq/' . $topic->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            {{-- NEW TITLE --}}
                            <div class="form-group">
                              <label for="new_title">Название</label>
                              <input type="text" class="form-control" name="new_title" value="{{ $topic->title }}">
                            </div>

                            <br>  
                            <button type="submit" class="btn btn-warning">Изменить и закрыть</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </td>{{-- EDIT --}}

              {{-- DELETE --}}
              <td>
                <button class="btn btn-danger" data-toggle="modal" data-target="#del{{ $topic->id }}">
                    Удалить
                  </button>
                  <div class="modal fade" id="del{{ $topic->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Подтверждение удаления</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('/admin/faq/' . $topic->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                              <h5>Вы точно хотите удалить тему {{ $topic->title }} и все вопросы связанные с ней?</h5>
                            </div>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </td>{{-- DELETE --}}

            </tr> 
          @endforeach
        </tbody>
      </table>
    </div> {{-- SHOW TOPICS --}}
  </div>
@endsection