@extends('layouts.client')

@section('content')
<style>
  body {
    background-color: #fff;
}

.container {
    max-width: 800px;
}

.card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    font-size: 1.8rem;
    background-color: #388da8;
    background-image: linear-gradient(135deg, #388da8, #6ab0c7);
    color: #fff;
}

.card-body {
    padding: 30px;
    background-color: #f9f9f9;
}

.form-check {
    display: flex;
    align-items: center;
    gap:10px;
}

.form-check-input {
    transform: scale(1.3);
    margin-right: 10px;
    cursor: pointer;
}

.form-check-label {
    font-size: 1.2rem;
    cursor: pointer;
    transition: color 0.3s, background-color 0.3s;
    padding: 10px;
    border-radius: 8px;
    width: 100%;
}

.form-check-input:checked + .form-check-label {
    background-color: #388da8;
    color: #fff;
    transform: scale(1.01);
}

.option-label:hover {
    background-color: #e0f7fa;
    color: #388da8;
}

.next-button, .prev-button {
    margin-top: 20px;
    font-size: 1.1rem;
    background-color: #388da8;
    color: #fff;
    border: none;
    transition: background-color 0.3s, transform 0.3s;
}

.next-button:hover, .prev-button:hover {
    background-color: #2a6d7e;
    transform: translateY(-2px);
}

#submit-button .btn {
    font-size: 1.2rem;
    padding: 12px;
    background-color: #388da8;
    border: none;
}

#submit-button .btn:hover {
    background-color: #2a6d7e;
}

.animated {
    animation-duration: 0.5s;
    animation-fill-mode: both;
}

.fadeIn {
    animation-name: fadeIn;
}

.fadeOut {
    animation-name: fadeOut;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}

</style>
<div class="m-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center bg-custom ">
                    <h3 class="text-white my-2">Quiz</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('client.test.store') }}" id="quizForm">
                        @csrf
                        @foreach ($questions as $index => $question)
                        <div class="question-div animated fadeIn" id="question-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }}">
                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-header fs-4 bg-custom-light text-white">{{ $question->question_text }}</div>
                                <div class="card-body">
                                    @foreach ($question->questionOptions as $option)
                                    <div class="form-check mb-3 d-flex align-items-center">
                                        <input class="form-check-input mr-3" type="radio"
                                            name="questions[{{ $question->id }}]" id="option-{{ $option->id }}"
                                            value="{{ $option->id }}">
                                        <label class="form-check-label option-label" for="option-{{ $option->id }}">
                                            {{ $option->option_text }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                @if ($index > 0)
                                <button type="button" class="btn btn-custom prev-button" style="width: 100px;">
                                    <i class="fas fa-arrow-left"></i> Prev
                                </button>
                                @endif
                                @if ($index < count($questions) - 1)
                                <button type="button" class="btn btn-custom next-button" style="width: 100px;">
                                    Next <i class="fas fa-arrow-right"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group row mb-0" id="submit-button" style="display: none;">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block mt-3">
                                    Submit <i class="fas fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      let currentIndex = 0;
      const questions = document.querySelectorAll('.question-div');
      const nextButtons = document.querySelectorAll('.next-button');
      const prevButtons = document.querySelectorAll('.prev-button');

      nextButtons.forEach((button, index) => {
          button.addEventListener('click', function() {
              navigateQuestion(currentIndex + 1);
          });
      });

      prevButtons.forEach((button, index) => {
          button.addEventListener('click', function() {
              navigateQuestion(currentIndex - 1);
          });
      });

      function navigateQuestion(index) {
          if (index >= 0 && index < questions.length) {
              questions[currentIndex].classList.add('fadeOut');
              setTimeout(() => {
                  questions[currentIndex].style.display = 'none';
                  questions[currentIndex].classList.remove('fadeOut');
                  currentIndex = index;
                  questions[currentIndex].style.display = 'block';
                  questions[currentIndex].classList.add('fadeIn');
                  if (currentIndex === questions.length - 1) {
                      document.getElementById('submit-button').style.display = 'block';
                  } else {
                      document.getElementById('submit-button').style.display = 'none';
                  }
              }, 500);
          }
      }
  });
</script>

@endsection
