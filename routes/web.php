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

// Course dashboard

Route::get('/home', 'HomeController@index');

// Unit page

Route::get('/unit/{unit_id}', 'UnitController@show');
Route::get('/unit/{unit_id}/download', 'UnitController@unit_download');
Route::get('/unit/{unit_id}/delete', 'UnitController@unit_delete');
Route::get('/unit/{unit_id}/section/{section_id}/download', 'SectionController@section_download');
Route::get('/unit/{unit_id}/section/{section_id}/delete', 'SectionController@section_delete');

// Unit info page

Route::get('/unit/{unit_id}/unit_info', 'UnitController@unit_info');
Route::get('/unit/{unit_id}/unit_info/file/{file_id}', 'UnitController@unit_info_file');
Route::get('/unit/{unit_id}/unit_info/file/{file_id}/download', 'UnitController@unit_info_download');
Route::get('/unit/{unit_id}/unit_info/file/{file_id}/delete', 'UnitController@unit_info_delete');

// Announcements

Route::get('/unit/{unit_id}/announcement', 'UnitController@announcements')->name('announcements');

// Assignments

Route::get('/unit/{unit_id}/assignments', 'AssignmentController@index')->name('assignments');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}', 'AssignmentController@assignment_file');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}/download', 'AssignmentController@assignment_download');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}/delete', 'AssignmentController@assignment_delete');
Route::get('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@show');
Route::post('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@submit');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}/cancel-submit', 'AssignmentController@cancel_submit');

// Grade routes

Route::get('/unit/{unit_id}/grade', 'GradeController@show');

// Forum routes

Route::get('/unit/{unit_id}/forum', 'ForumController@thread_index');
Route::get('/unit/{unit_id}/forum/create', 'ForumController@thread_create');
Route::post('/unit/{unit_id}/forum', 'ForumController@thread_store');
Route::get('/unit/{unit_id}/forum/{thread_id}/delete', 'ForumController@thread_delete');

// Thread routes

Route::get('/unit/{unit_id}/forum/{thread_id}', 'ForumController@post_index');
Route::post('/unit/{unit_id}/forum/{thread_id}', 'ForumController@post_store');
Route::post('/unit/{unit_id}/forum/{thread_id}/post/{post_id}/edit', 'ForumController@post_update');
Route::get('/unit/{unit_id}/forum/{thread_id}/post/{post_id}/delete', 'ForumController@post_delete');

// Section routes

Route::get('/unit/{unit_id}/section/{section_id}', 'SectionController@index');

// Download section routes

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/download', 'SectionController@subsection_download');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/delete', 'SectionController@subsection_delete');

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/download', 'SectionController@individual_download');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/delete', 'SectionController@individual_delete');

// Quiz routes

Route::get('/unit/{unit_id}/section/{section_id}/file/{file_id}', 'SectionController@file');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/complete', 'SectionController@complete');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/incomplete', 'SectionController@incomplete');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/complete', 'SectionController@quiz_complete');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/incomplete', 'SectionController@quiz_incomplete');

// Question routes

Route::get('/unit/{unit_id}/section/{section_id}/quiz/{quiz_id}', 'QuizController@quiz_start');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/start', 'QuizController@start');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/question/{question_no}', 'QuizController@question');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/previous', 'QuizController@save');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/next', 'QuizController@save');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/review', 'QuizController@save');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/review', 'QuizController@quiz_review');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/submit', 'QuizController@submit');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/summary/{attempt_no}', 'QuizController@quiz_summary');


// Other routes

Route::get('/grades', 'GradeController@index');

Route::get('/calendar', 'CalendarController@index');

Route::get('/calendar/create', 'CalendarController@create');

Route::post('/calendar', 'CalendarController@store');

Route::get('/messages', 'MessageController@index');

Route::get('/messages/create', 'MessageController@create');

Route::post('/messages', 'MessageController@store');

// Notifications

Route::get('/notifications', 'NotificationController@index');
Route::get('/notifications/delete', 'NotificationController@notifications_delete');
Route::get('/notification/{notification_id}/delete', 'NotificationController@notification_delete');


Route::get('/downloads', 'DownloadController@index');
