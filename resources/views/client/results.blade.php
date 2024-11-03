@extends('layouts.client')

@section('content')
<style>
    body {
        background-color: #f0f0f5;
        font-family: 'Roboto', sans-serif;
        overflow-x:hidden;
    }

    .result-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .result-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 30px;
        max-width: 400px;
        width: 100%;
        z-index: 1;
    }

    .result-card h1 {
        font-size: 3rem;
        color: #4caf50;
    }

    .result-card p {
        font-size: 1.25rem;
        margin: 10px 0;
    }

    .result-card .score {
        font-size: 2rem;
        margin: 20px 0;
    }

    .result-card .correct {
        color: #53BB57;
        font-size: 70px;
    }

    .result-card .incorrect {
        color: #f44336;
    }

    .result-card .btn {
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        margin-top: 20px;
        cursor: pointer;
        font-size: 1rem;
    }

    .result-card .btn:hover {
        background-color: #45a049;
    }

    .result-card .social-btn {
        background-color: #3b5998;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        margin-top: 10px;
        cursor: pointer;
        font-size: 1rem;
        display: inline-block;
    }

    .result-card .social-btn:hover {
        background-color: #3b5998;
    }

    .result-card .social-btn.twitter {
        background-color: #55acee;
    }

    .result-card .social-btn.twitter:hover {
        background-color: #55acee;
    }

    /* Confetti styles */
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: #f44336;
        top: -10px;
        animation: confetti-fall 3s linear infinite;
    }

    .confetti:nth-child(2n) {
        background-color: #ffeb3b;
    }

    .confetti:nth-child(3n) {
        background-color: #4caf50;
    }

    .confetti:nth-child(4n) {
        background-color: #2196f3;
    }

    @keyframes confetti-fall {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }
</style>

<div class="result-container">
    <div class="result-card">
        <h1>{{ $result->rank }}</h1>
        <p>Congratulations!</p>
        <div class="score">
            <span class="correct fw-bold">{{ $result->total_points }}</span> 
        </div>
        <button class="btn" onclick="window.location.href='{{ route('answers.show', $result->id) }}'">See Answers</button>
        <div class="social-share">
            <button class="social-btn" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}', 'facebook-share-dialog', 'width=800,height=600')">Share</button>
            <button class="social-btn twitter" onclick="window.open('https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text=I got the {{ $result->rank }}th place in this quiz!', 'twitter-share-dialog', 'width=800,height=600')">Tweet</button>
        </div>
    </div>
</div>

<!-- Confetti elements -->
<div class="confetti-container">
    @for ($i = 0; $i < 100; $i++)
        <div class="confetti" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 30) / 10 }}s;"></div>
    @endfor
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize confetti animation
        console.log("Confetti animation initialized");
    });
</script>
@endsection
