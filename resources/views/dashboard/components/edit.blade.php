<td>
  <button class="btn btn-info" data-toggle="modal" data-target="#{{ $question->id }}">
    Изменить
  </button>
  <div class="modal fade" id="{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/admin/faq/topic/' . $question->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
              <label for="new_text">Вопрос</label>
              <textarea class="form-control" rows="3" name="new_text">{{ $question->text }}</textarea>
            </div>

            <div class="form-group">
              <label for="new_answer">Ответ</label>
              <textarea class="form-control" rows="3" name="new_answer">{{ $question->answer }}</textarea>
            </div>

            <div class="form-group">
              <label for="new_topic">Выберете тему:</label>
      				<select class="form-control" id="new_topic" name="new_topic">
      					@foreach ($topics as $topic)
      				  	<option value="{{ $topic->id }}">{{ $topic->title }}</option>
      				  @endforeach
      				</select>
            </div>

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
</td>