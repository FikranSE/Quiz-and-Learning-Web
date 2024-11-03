<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rute untuk menampilkan jawaban berdasarkan hasil


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect()->route('user.home');
});
Route::get('homeUser', [\App\Http\Controllers\HomeController::class, 'homeUser'])->name('user.home');
Route::group(['middleware' => 'auth'], function () {
  route::put('ilustrasi/update', [\App\Http\Controllers\IlustrasiController::class, 'update'])->name('ilustrasi.update');
  Route::get('videos/index', [\App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');
  Route::get('videos/show', [\App\Http\Controllers\VideoController::class, 'show'])->name('videos.show');
  Route::get('videos/create', [\App\Http\Controllers\VideoController::class, 'create'])->name('videos.create');
  Route::post('videos/store', [\App\Http\Controllers\VideoController::class, 'store'])->name('videos.store');
  Route::get('videos/edit/{id}', [\App\Http\Controllers\VideoController::class, 'edit'])->name('videos.edit');
  Route::put('videos/update/{video}', [\App\Http\Controllers\VideoController::class, 'update'])->name('videos.update'); // Adjusted route name
  Route::delete('videos/{video}', [\App\Http\Controllers\VideoController::class, 'delete'])->name('videos.delete');
  Route::get('evaluasi', [\App\Http\Controllers\TestController::class, 'evaluasi'])->name('client.evaluasi');
  Route::get('test', [\App\Http\Controllers\TestController::class, 'index'])->name('client.test');
  Route::post('test', [\App\Http\Controllers\TestController::class, 'store'])->name('client.test.store');
  Route::get('results/{result_id}', [\App\Http\Controllers\ResultController::class, 'show'])->name('client.results.show');
  Route::get('results_eval/{result_id}', [\App\Http\Controllers\ResultController::class, 'show'])->name('client.results.show');
  Route::get('answers/{id}', [\App\Http\Controllers\AnswerController::class, 'show'])->name('answers.show');

  Route::get('/test/complete', [\App\Http\Controllers\TestController::class, 'complete'])->name('client.test.complete');
  // admin only
  Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::delete('permissions_mass_destroy', [\App\Http\Controllers\Admin\PermissionController::class, 'massDestroy'])->name('permissions.mass_destroy');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::delete('roles_mass_destroy', [\App\Http\Controllers\Admin\RoleController::class, 'massDestroy'])->name('roles.mass_destroy');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::delete('users_mass_destroy', [\App\Http\Controllers\Admin\UserController::class, 'massDestroy'])->name('users.mass_destroy');

    // categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::delete('categories_mass_destroy', [\App\Http\Controllers\Admin\CategoryController::class, 'massDestroy'])->name('categories.mass_destroy');

    // questions
    Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class);
    Route::delete('questions_mass_destroy', [\App\Http\Controllers\Admin\QuestionController::class, 'massDestroy'])->name('questions.mass_destroy');

    // options
    Route::resource('options', \App\Http\Controllers\Admin\OptionController::class);
    Route::delete('options_mass_destroy', [\App\Http\Controllers\Admin\OptionController::class, 'massDestroy'])->name('options.mass_destroy');

    // results
    Route::resource('results', \App\Http\Controllers\Admin\ResultController::class);
    Route::delete('results_mass_destroy', [\App\Http\Controllers\Admin\ResultController::class, 'massDestroy'])->name('results.mass_destroy');
  });
});

Auth::routes();