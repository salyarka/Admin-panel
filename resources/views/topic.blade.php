@extends('layouts.admin_panel')

@section('content')
	<div class="card">
    <div class="header">
      <h3>Тема {{ $topics->first()->title }}</h3>
    </div>
	
  	{{-- SHOW QUESTIONS --}}
  	<div>
      <table class="table text-left">
        <thead>
          <tr>
            <th>Текст</th>
            <th>Ответ</th>
            <th>Статус</th>
            <th>Дата создания</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($questions as $question)
            <tr>
              <td>{{ $question->text }}</td>
              <td>
              	@if ($question->answer)
              		{{ $question->answer }}
              	@else
              		<button class="btn btn-primary" data-toggle="modal" data-target="#answer{{ $question->id }}">
                    Ответить
                  </button>
                  <div class="modal fade" id="answer{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Ответ</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('/admin/faq/topic/' . $question->id . '/answer') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            {{-- ANSWER --}}
                            <div class="form-group">
                              <input type="text" class="form-control" name="answer">
                            </div>

														<div class="checkbox">
														  <label>
														    <input type="checkbox" name="with_publication" value="1">
														    	Добавить вопрос с публикацией
														  </label>
														</div>

                            <button type="submit" class="btn btn-warning">Добавить и закрыть</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              	@endif
              </td>
              <td>
              	@if ($question->answer && $question->status == 1)
              		опубликован
              	@elseif ($question->answer && $question->status == 0)
              		скрыт
              	@elseif (!$question->answer)
              		ожидает ответ
              	@endif
              </td>

              {{-- DATE ADDED --}}
              <td>
              	{{ Carbon\Carbon::parse($question->created_at)->format('d-m-Y') }}
              </td>

              {{-- PUBLIC --}}
              <td>
              	@if ($question->answer && $question->status == 1)
              		<form action="{{ url('/admin/faq/topic/' . $question->id) }}" method="POST">
                  	{{ csrf_field() }}
                  	{{ method_field('PATCH') }}
                  	<button type="submit" class="btn btn-warning">скрыть</button>
              		</form>
              	@elseif ($question->answer && $question->status == 0)
              		<form action="{{ url('/admin/faq/topic/' . $question->id) }}" method="POST">
                  	{{ csrf_field() }}
                  	{{ method_field('PATCH') }}
                  	<button type="submit" class="btn btn-success">опубликовать</button>
                  </form>
              	@endif
              </td>

              {{-- EDIT --}}
              <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#{{ $question->id }}">
                    Изменить
                  </button>
                  <div class="modal fade" id="{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Тема</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('/admin/faq/topic/' . $question->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            {{-- NEW TEXT --}}
                            <div class="form-group">
                              <label for="new_title">Вопрос</label>
                              <input type="text" class="form-control" name="new_text" value="{{ $question->text }}">
                            </div>

                            {{-- NEW ANSWER --}}
                            <div class="form-group">
                              <label for="new_title">Ответ</label>
                              <input type="text" class="form-control" name="new_answer" value="{{ $question->answer }}">
                            </div>

                            {{-- TOPIC --}}
                            <div class="form-group">
                              <label for="new_topic">Выберете тему:</label>
      												<select class="form-control" id="new_topic" name="new_topic">
      													@foreach ($topics as $topic)
      												  	<option value="{{ $topic->id }}">{{ $topic->title }}</option>
      												  @endforeach
      												</select>
                            </div>

                            {{-- NEW AUTHOR --}}
                            <div class="form-group">
                              <label for="new_title">Имя автора</label>
                              <input type="text" class="form-control" name="new_author_name" value="{{ $question->author_name }}">
                            </div>

                            <button type="submit" class="btn btn-warning">Изменить и закрыть</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </td>{{-- EDIT --}}

              {{-- DELETE --}}
              <td>
                <button class="btn btn-danger" data-toggle="modal" data-target="#del{{ $question->id }}">
                    Удалить
                  </button>
                  <div class="modal fade" id="del{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Подтверждение удаления</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ url('/admin/faq/topic/' . $question->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                              <h5>Вы точно хотите удалить вопрос?</h5>
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
    </div>
  </div>
@endsection