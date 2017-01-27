@extends('layouts.admin_panel')

@section('title', 'вопросами')

@section('content')
@if (count($questions) > 0)
	<div class="card">
    <div class="header">
      <h3>Вопросы без ответов</h3>
    </div>
  	<div>
      <table class="table text-left">
        <thead>
          <tr>
            <th>Текст</th>
            <th class="text-center">Дата создания</th>
            <th class="text-center">Тема</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($questions as $question)
            <tr>
              @include('dashboard.components.text_and_date')
              <td class="text-center">{{ $question->topic->title }}</td>
              <td>@include('dashboard.components.answer_question')</td>
              @include('dashboard.components.edit')
              @include('dashboard.components.delete')
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@else
  <h3>На данный момент нет неотвеченных вопросов</h3>
@endif
@endsection
