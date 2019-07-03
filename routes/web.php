<?php

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

Route::get('/', 'Auth\LoginController@login');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {

        Route::get('/', 'HomeController@index')->name('home');

        Route::middleware('manager')->group(function () {
            Route::apiResources([
                'tasks' => 'TaskController'
            ]);

            Route::get('/task/create', 'TaskController@create')->name('tasks.create');
            Route::post('/task/user', 'TaskController@userTask')->name('tasks.users');
            Route::get('/assigned/tasks', 'TaskController@assignedTasks')->name('tasks.assigned');
        });

        Route::middleware('developer')->group(function () {
            Route::get('/developer/tasks', 'TaskController@developerTasks')->name('tasks.developers');
            Route::post('/developer/tasks/{task}', 'TaskController@taskStatus')->name('tasks.status');
        });
    });
});


