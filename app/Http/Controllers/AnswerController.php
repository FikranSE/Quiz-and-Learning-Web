<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class AnswerController extends Controller
{
  public function show($id)
{
    // Fetch the result and related questions with options
    $result = Result::with(['questions.questionOptions', 'questions.category'])
        ->findOrFail($id);

    // Check if any of the questions belong to the 'evaluasi' category
    $hasEvaluasiCategory = $result->questions->contains(function ($question) {
        return $question->category->name === 'evaluasi';
    });

    return view('client.answer', compact('result', 'hasEvaluasiCategory'));
}

  
}