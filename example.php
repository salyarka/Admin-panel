@foreach ($topics as $topic)
    @if ($topic->haveAnsweredQuestions($topic->id))
        {{ $topic->title }}
             @foreach ($topic->answeredQuestions as $question)
                {{ $question->text }}
                {{ $question->answer }}
            @endforeach
    @endif
@endforeach
