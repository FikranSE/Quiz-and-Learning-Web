<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;

class TestController extends Controller
{
  public function index()
  {
    $questions = Question::with('questionOptions')
      ->whereHas('category', function ($query) {
        $query->where('name', '!=', 'evaluasi'); // Adjust the field name if needed (e.g., 'name')
      })
      ->get(); // Fetch filtered questions
    return view('client.test', compact('questions'));
  }
  
  public function evaluasi()
  {
      // Fetch categories with their questions
      $categories = Category::with(['categoryQuestions.questionOptions'])
          ->whereHas('categoryQuestions', function ($query) {
              $query->whereHas('category', function ($q) {
                  $q->where('name', 'evaluasi'); // Filter only 'evaluasi' category
              });
          })
          ->get();
  
      return view('client.evaluasi', compact('categories'));
  }
  



  public function store(StoreTestRequest $request)
  {
    $options = Option::find(array_values($request->input('questions')));

    $result = auth()->user()->userResults()->create([
      'total_points' => $options->sum('points')
    ]);

    $questions = $options->mapWithKeys(function ($option) {
      return [
        $option->question_id => [
          'option_id' => $option->id,
          'points' => $option->points
        ]
      ];
    })->toArray();

    $result->questions()->sync($questions);

    return redirect()->route('client.results.show', $result->id);
  }
}