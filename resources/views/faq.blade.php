<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ url('css/reset.css') }}">
	<link rel="stylesheet" href="{{ url('css/style.css') }}">
	<script src="{{ url('js/modernizr.js') }}"></script>
	<title>FAQ Template | CodyHouse</title>
</head>
<body>
<header>
	<h1>FAQ Template</h1>
</header>
{{-- ERRORS --}}
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning">
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        {{ $error }}
		    	</div>
            @endforeach
        </ul>
    </div>
@endif
{{-- FLASH MESSAGES --}}
@if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('flash_notification.message') }}
    </div>
@endif
{{-- SIDE SECTION NAVIGATION --}}
<section class="cd-faq">
	<ul class="cd-faq-categories">
		<li><a class="selected" href="#basics">Basics</a></li>
		<li><a href="#mobile">Mobile</a></li>
		<li><a href="#account">Account</a></li>
		<li><a href="#payments">Payments</a></li>
		<li><a href="#privacy">Privacy</a></li>
		<li><a href="#delivery">Delivery</a></li>
	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
		{{-- QUESTION FORM --}}
		<form action="{{ url('faq') }}" method="POST">
			{{ csrf_field() }}
			<label for="email">Ваша почта</label>
			<input type="email" name="email">
			<label for="author_name">Ваше имя</label>
			<input type="text" name="author_name">
			<label for="text">Вопрос</label>
			<input type="text" name="text">
            <select name="topic_id">
                @foreach ($topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                @endforeach
            </select>
			<button type="submit">Отправить</button>
		</form>
		{{-- REMAKE --}}
		@foreach ($topics as $topic)
			@if ($topic->haveAnsweredQuestions($topic->id))
				<ul id="basics" class="cd-faq-group">
					<li class="cd-faq-title"><h2>{{ $topic->title }}</h2></li>	
					@foreach ($questions as $question)
						@if ($question->topic_id == $topic->id)
							<li>
								<a class="cd-faq-trigger" href="#0">{{ $question->text }}</a>
								<div class="cd-faq-content">
									<p>{{ $question->answer }}</p>
								</div>
							</li>
						@endif
					@endforeach	
				</ul>
			@endif
		@endforeach
	</div> <!-- cd-faq-items -->
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="{{ url('js/jquery-2.1.1.js') }}"></script>
<script src="{{ url('js/jquery.mobile.custom.min.js') }}"></script>
<script src="{{ url('js/main.js') }}"></script>
</body>
</html>