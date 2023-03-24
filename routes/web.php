<?php

//use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', '\App\Http\Controllers\HomeController@index')->name('home');

    Route::get('/folders/create', '\App\Http\Controllers\FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', '\App\Http\Controllers\FolderController@create');


    Route::group(['middleware' => 'can:view,folder'], function () {
        Route::get('/folders/{folder}/tasks', '\App\Http\Controllers\TaskController@index')->name('tasks.index');

        Route::get('/folders/{folder}/tasks/create', '\App\Http\Controllers\TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', '\App\Http\Controllers\TaskController@create');

        Route::get('/folders/{folder}/tasks/{task}/edit', '\App\Http\Controllers\TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', '\App\Http\Controllers\TaskController@edit');
    });
});
