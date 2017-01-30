@extends('layouts.app')

@section('title', 'заблокированными вопросами')

@section('navbar')
  @include('dashboard.components.navbar')
@endsection

@section('content')
 <div class="card">
  <div class="header">
    <h3>Заблокированные вопросы</h3>
  </div>

  {{-- ADD FORBIDDEN WORD --}}
  <div class="col-sm-3 sidenav">
    <div class="card">
      <div class="panel-heading">Управление запретными словами</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/blocked') }}">
            {{ csrf_field() }}

            {{-- WORD  --}}
            <div class="form-group">
              <label for="word" class="col-md-4 control-label">Cлово</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="word" required autofocus>
              </div>
            </div>

            {{-- SUBMIT --}}
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-info">
                  Добавить
                </button>
              </div>
            </div>    
          </form>

          {{-- SHOW LIST OF WORDS --}}
          <button class="btn btn-primary" data-toggle="modal" data-target="#forbidden_words">
            Показать список запретных слов
          </button>
          
          <div class="modal fade" id="forbidden_words" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                  <table class="table text-left">
                    @foreach ($forbiddens as $forbidden)
                      <tr>
                        <td>{{ $forbidden->word }}</td>
                        <td>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#delword{{ $forbidden->id }}">
                          Удалить
                        </button>
                        <div class="modal fade" id="delword{{ $forbidden->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Подтверждение удаления</h4>
                              </div>

                              <div class="modal-body">
                                <form action="{{ url('/admin/blocked/' . $forbidden->id) }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <div class="form-group">
                                    <h5>Вы точно хотите удалить слово?</h5>
                                  </div>
                                  <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                              </div>
        
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach     
                  </table>                       
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  {{-- SHOW BLOCKED QUESTIONS --}}
  <div class="col-sm-9">
    @if (count($questions) > 0)
          <table class="table text-left">
            <thead>
              <tr>
                <th>Текст</th>
                <th class="text-center">Дата создания</th>
                <th class="text-center">Тема</th>
                <th>Запрещенные слова</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions as $question)
                <tr>
                  @include('dashboard.components.text_and_date')
                  <td class="text-center">{{ $question->topic->title }}</td>
                  <td class="text-center">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#words{{ $question->id }}">
                        Показать
                      </button>
                      <div class="modal fade" id="words{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <ul class="list-group">
                                @foreach ($question->getBlockedWords() as $word)
                                  <li class="list-group-item">{{ $word }}</li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                  </td>
                  @include('dashboard.components.edit')
                  @include('dashboard.components.delete')
                </tr> 
              @endforeach
            </tbody>
          </table>
        </div>
    @else
      <h3 class="text-left">На данный момент нет заблокированных вопросов</h3>
    @endif
  </div>

@endsection