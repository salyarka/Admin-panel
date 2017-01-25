@extends('layouts.admin_panel')

@section('content')
	<div class="card">
    <div class="header">
      <h3>Вопросы</h3>
    </div>
	
	{{-- SIDE CONTENT --}}
		<div class="col-sm-3 sidenav">
  		<div class="card">
    		<div class="panel-heading">Добавление новой темы</div>
      	<div class="panel-body">

      	</div>
    	</div>
  	</div>

  	{{-- SHOW QUESTIONS --}}
  	<div class="col-sm-9">
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
              		У данного вопроса нет ответа.
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
              <td>{{ Carbon\Carbon::parse($question->created_at)->format('d-m-Y') }}</td>

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
                          <form action="{{ url('/admin/faq/topic/' . $question->topc_id . '/' . $question->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            {{-- NEW TITLE --}}
                            <div class="form-group">
                              <label for="new_title">Название</label>
                              <input type="text" class="form-control" name="new_title" value="{{ $question->title }}">
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
                          <form action="{{ url('/admin/faq/topic/' . $question->topic_id . '/' . $question->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                              <h5>Вы точно хотите удалить тему {{ $question->title }} и все вопросы связанные с ней?</h5>
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