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
</td>