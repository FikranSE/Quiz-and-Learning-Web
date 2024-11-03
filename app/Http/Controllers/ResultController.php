<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
  public function show($result_id)
  {
    $result = Result::whereHas('user', function ($query) {
      $query->whereId(auth()->id());
    })->findOrFail($result_id);

    return view('client.results', compact('result'));
  }

  public function show_eval($result_id)
  {
    $result = Result::whereHas('user', function ($query) {
      $query->whereId(auth()->id());
    })->findOrFail($result_id);

    // Filter questions to only include those in the "evaluation" category
    $evaluationQuestions = $result->questions()->whereHas('category', function ($query) {
      $query->where('name', 'evaluasi');
    })->get();

    return view('client.results_eval', compact('result', 'evaluationQuestions'));
  }
}