@extends('layouts.client')

@section('content')
<style>
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .question {
        margin-bottom: 20px;
    }

    .question h3 {
        margin-bottom: 10px;
    }

    .question p {
        margin: 5px 0;
    }

    .correct-answer {
        color: green;
    }

    .your-answer {
        color: blue;
    }

    .incorrect-answer {
        color: red;
    }
</style>

<div class="container">
  <h1>Answers for Result #{{ $result->id }}</h1>

  <!-- Logika untuk menampilkan jawaban -->
  @foreach($result->questions as $question)
  <div class="question">
      <h3>{{ $question->question_text }}</h3>
      @php
          $userOption = $question->questionOptions->find($question->pivot->option_id);
          $correctOption = $question->questionOptions->firstWhere('points', '>', 0);
      @endphp
      <p class="your-answer">Your Answer: {{ $userOption ? $userOption->option_text : 'N/A' }}</p>
      <p class="correct-answer">Correct Answer: {{ $correctOption ? $correctOption->option_text : 'N/A' }}</p>
      @if($userOption && $correctOption && $userOption->id != $correctOption->id)
          <p class="incorrect-answer">Incorrect</p>
      @endif
  </div>
  @endforeach

  <!-- Conditionally display the button -->
  <div class="mt-4">
      @if($hasEvaluasiCategory)
          <a href="/" class="btn btn-primary">
              Go Home
          </a>
      @else
          <a href="{{ route('client.evaluasi') }}" class="btn btn-primary">
              Go to Evaluation Test
          </a>
      @endif
  </div>
</div>



@endsection
