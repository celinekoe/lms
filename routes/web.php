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

Route::get('/', function(){
	return redirect('/home');
});

Auth::routes();

Route::get('/reset', 'Controller@reset');

// Course dashboard

Route::get('/home', 'HomeController@home');

// Unit page

Route::get('/unit/{unit_id}', 'UnitController@unit');
Route::get('/unit/{unit_id}/download', 'UnitController@unit_download');
Route::get('/unit/{unit_id}/delete', 'UnitController@unit_delete');
Route::get('/unit/{unit_id}/sections/download', 'UnitController@sections_download');
Route::get('/unit/{unit_id}/sections/delete', 'UnitController@sections_delete');
Route::get('/unit/{unit_id}/section/{section_id}/download', 'SectionController@section_download');
Route::get('/unit/{unit_id}/section/{section_id}/delete', 'SectionController@section_delete');

// Unit info page

Route::get('/unit/{unit_id}/unit_info', 'UnitController@unit_info');
Route::get('/unit/{unit_id}/unit_info/download', 'UnitController@unit_info_download');
Route::get('/unit/{unit_id}/unit_info/delete', 'UnitController@unit_info_delete');
Route::get('/unit/{unit_id}/unit_info/file/{file_id}', 'UnitController@unit_info_file');
Route::get('/unit/{unit_id}/unit_info/file/{file_id}/download', 'UnitController@unit_info_file_download');
Route::get('/unit/{unit_id}/unit_info/file/{file_id}/delete', 'UnitController@unit_info_file_delete');

// Announcements

Route::get('/unit/{unit_id}/announcements', 'UnitController@announcements');
Route::get('/unit/{unit_id}/announcement/{announcement_id}', 'UnitController@announcement');

// Assignments

Route::get('/unit/{unit_id}/assignments', 'AssignmentController@assignments');
Route::get('/unit/{unit_id}/assignments/download', 'AssignmentController@assignments_download');
Route::get('/unit/{unit_id}/assignments/delete', 'AssignmentController@assignments_delete');
Route::get('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@assignment');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/download', 'AssignmentController@assignment_download');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/delete', 'AssignmentController@assignment_delete');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}', 'AssignmentController@assignment_file');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}/download', 'AssignmentController@assignment_file_download');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}/delete', 'AssignmentController@assignment_file_delete');

Route::post('/unit/{unit_id}/assignment/{assignment_id}', 'AssignmentController@submit');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/uploaded_file/{file_id}', 'AssignmentController@uploaded_assignment_file');
Route::get('/unit/{unit_id}/assignment/{assignment_id}/file/{file_id}/cancel-submit', 'AssignmentController@cancel_submit');

// Grade routes

Route::get('/unit/{unit_id}/grades', 'GradeController@show');

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

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/download', 'SectionController@file_download');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/delete', 'SectionController@file_delete');

// Quiz routes

Route::get('/unit/{unit_id}/section/{section_id}/file/{file_id}', 'SectionController@file');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/complete', 'SectionController@complete');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/file/{file_id}/incomplete', 'SectionController@incomplete');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/complete', 'SectionController@quiz_complete');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/incomplete', 'SectionController@quiz_incomplete');

// Question routes

Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}', 'QuizController@quiz_start');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/start', 'QuizController@start');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/question/{question_no}', 'QuizController@question');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/save', 'QuizController@save');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/review', 'QuizController@quiz_review');
Route::post('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/submit', 'QuizController@submit');
Route::get('/unit/{unit_id}/section/{section_id}/subsection/{subsection_id}/quiz/{quiz_id}/summary/{attempt_no}', 'QuizController@quiz_summary');


// Calendar

Route::get('/calendar', 'CalendarController@index');
Route::get('/calendar/create', 'CalendarController@create');
Route::post('/calendar', 'CalendarController@store');
Route::get('/calendar/{event_id}/edit', 'CalendarController@edit_event');
Route::post('/calendar/{event_id}', 'CalendarController@update_event');
Route::delete('/calendar/{event_id}', 'CalendarController@delete_event');

// Messages

Route::get('/messages', 'MessageController@messages');
Route::get('/contacts', 'MessageController@contacts');
Route::get('/message/{message_thread_id}', 'MessageController@message');
Route::post('/message/{message_thread_id}/send', 'MessageController@send_message');
Route::get('/message/{message_id}/delete', 'MessageController@delete_message');


// Notifications

Route::get('/notifications', 'NotificationController@index');
Route::get('/notifications/delete', 'NotificationController@notifications_delete');
Route::get('/notification/{notification_id}/delete', 'NotificationController@notification_delete');

// Downloads Page

Route::get('/downloads', 'DownloadController@downloads');

// Other routes

Route::get('/grades', 'GradeController@index');

