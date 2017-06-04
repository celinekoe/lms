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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/unit/{id}', 'UnitController@show')->name('unit');

Route::get('/unit/{unit_id}/info', 'UnitController@info')->name('unit_info');

Route::get('/unit/{unit_id}/announcement', 'UnitController@announcements')->name('announcements');

Route::get('/unit/{unit_id}/assignment', 'AssignmentController@index')->name('assignments');

Route::get('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@show');

Route::post('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@submit');

Route::get('/unit/{unit_id}/grade', 'UnitController@grades')->name('grades');

Route::get('/unit/{unit_id}/section/{section_id}', 'SectionController@show')->name('section');

Route::get('/unit/{unit_id}/section/{section_id}/file/{file_id}', 'SectionController@file');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/download', 'SectionController@download');

Route::get('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}', 'QuizController@show')->name('quiz');

Route::get('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}/question/{question_no}', 'QuestionController@show')->name('question');

Route::post('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}/question/{question_no}', 'QuizController@next')->name('next');

Route::post('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}/question/{question_no}/submit', 'QuizController@submit')->name('submit');


// Submit