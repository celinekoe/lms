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

Route::get('/unit/{unit_id}/assignments', 'AssignmentController@index')->name('assignments');

Route::get('/unit/{unit_id}/assignments/{assignment_id}/file/{file_id}', 'AssignmentController@assignments_file');

Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}', 'AssignmentController@assignment_file');

Route::get('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@show');

Route::post('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@submit');

Route::get('/unit/{unit_id}/grade', 'GradeController@show');

Route::get('/unit/{unit_id}/forum/create', 'ForumController@threadcreate');
Route::get('/unit/{unit_id}/forum', 'ForumController@threadindex');
Route::post('/unit/{unit_id}/forum', 'ForumController@threadstore');
Route::get('/unit/{unit_id}/forum/{thread_id}', 'ForumController@postindex');
Route::post('/unit/{unit_id}/forum/{thread_id}', 'ForumController@poststore');

// Section routes

Route::get('/unit/{unit_id}/section/{section_id}', 'SectionController@index');

// Download section routes

Route::get('/unit/{unit_id}/section/{section_id}/download', 'SectionController@section_download');
Route::get('/unit/{unit_id}/section/{section_id}/delete', 'SectionController@section_delete');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/download', 'SectionController@subsection_download');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/delete', 'SectionController@subsection_delete');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/download', 'SectionController@individual_download');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/delete', 'SectionController@individual_delete');

// Complete section routes

Route::get('/unit/{unit_id}/section/{section_id}/file/{file_id}', 'SectionController@file');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/complete', 'SectionController@complete');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/incomplete', 'SectionController@incomplete');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/complete', 'SectionController@quiz_complete');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/incomplete', 'SectionController@quiz_incomplete');

// Other section routes

Route::get('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}', 'QuizController@show');
Route::get('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}/question/{question_no}', 'QuestionController@show');
Route::post('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}/question/{question_no}/submit', 'QuizController@submit');
Route::post('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}/question/{question_no}', 'QuizController@next');

// Other routes

Route::get('/grades', 'GradeController@index');

Route::get('/calendar', 'CalendarController@index');

Route::get('/calendar/create', 'CalendarController@create');

Route::post('/calendar', 'CalendarController@store');

Route::get('/messages', 'MessageController@index');

Route::get('/messages/create', 'MessageController@create');

Route::post('/messages', 'MessageController@store');

Route::get('/notifications', 'NotificationController@index');

Route::get('/downloads', 'DownloadController@index');
