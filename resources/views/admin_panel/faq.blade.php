@extends('layouts.admin_panel')

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
              <td>{{ $topic->title }}</td>
              <td>{{ $topic->totalQuestions() }}</td>
              <td>{{ $topic->publishedQuestions() }}</td>
              <td>{{ $topic->noAnswerQuestions() }}</td>
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div> {{-- SHOW TOPICS --}}
  </div>
@endsection