@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
  <div class="card">
    <div class="header">
      <h3>FAQ</h3>
    </div>

    <div class="col-md-3 sidenav">
      <div class="sidebar-nav-fixed affix">
        <div class="well">
          <ul class="nav">
            <li class="nav-header"><h4>Темы</h4></li>
            @foreach ($topics as $topic)
              <li><a href="#{{ $topic->title }}">{{ $topic->title }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      @foreach ($topics as $topic)
        @if ($topic->publishedQuestions() > 0)
          <h3 id="{{ $topic->title }}"><span class="label label-default">{{ $topic->title }}</span></h3>
          @foreach ($topic->questions as $question)
            @if ($question->status != 0 && $question->answer)
              <div class="panel panel-default text-left">
                <div class="panel-heading">{{ $question->text }}</div>
                  <div class="panel-body">
                    {{ $question->answer }}
                  </div>
              </div>
            @endif
          @endforeach 
        @endif  
      @endforeach  
    </div>

    <div class="col-md-3">
      <button class="btn btn-info btn-fixed" data-toggle="modal" data-spy="affix" data-target="#question">
        Задать вопрос
      </button>
      <div class="modal fade" id="question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <form action="{{ url('/faq') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                  <label for="email">Ваша электронная почта</label>
                  <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group">
                  <label for="author_name">Ваше имя</label>
                  <input type="text" class="form-control" name="author_name">
                </div>

                <div class="form-group">
                  <label for="topic_id">Выберете тему:</label>
                  <select class="form-control" id="new_topic" name="topic_id">
                    @foreach ($topics as $topic)
                      <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="text">Вопрос</label>
                  <textarea class="form-control" rows="3" name="text"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Отправить</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection