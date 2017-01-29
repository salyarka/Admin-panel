@extends('layouts.app')

@section('title', 'темой')

@section('navbar')
  @include('dashboard.components.navbar')
@endsection

@section('content')
	<div class="card">
    <div class="header">
      {{-- <h3>Тема {{ $topics->find($id)->title }}</h3> --}}
      <h3>Тема {{ $topic->title }}</h3>      
    </div>
	  @if (count($topic->questions) > 0)
  	{{-- SHOW QUESTIONS --}}
  	<div>
      <table class="table text-left">
        <thead>
          <tr>
            <th>Текст</th>
            <th class="text-center">Дата создания</th>
            <th class="text-center">Статус</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($topic->questions as $question)
            <tr>
              @include('dashboard.components.text_and_date')

              {{-- STATUS --}}
              <td class="text-center">
              	@if ($question->answer && $question->status == 1)
              		<span class="label label-success">Опубликован</span>
              	@elseif ($question->answer && $question->status == 0)
              		<span class="label label-warning">Скрыт</span>
              	@elseif (!$question->answer)
              		<span class="label label-danger">Ожидает ответ</span>
              	@endif
              </td>

              {{-- PUBLIC --}}
              <td class="text-center">
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
                @else
                  @include('dashboard.components.answer_question')
              	@endif
              </td>
                        
              @include('dashboard.components.edit')
              @include('dashboard.components.delete')
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div>{{-- SHOW QUESTIONS --}}
    @else
      <h3>В этой теме нет вопросов</h3>
    @endif
  </div>
@endsection