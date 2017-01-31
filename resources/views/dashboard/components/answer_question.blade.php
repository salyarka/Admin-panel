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

          <div class="form-group">
            <textarea class="form-control" rows="3" name="answer"></textarea>
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
