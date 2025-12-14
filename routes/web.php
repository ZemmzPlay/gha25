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


Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {


    Route::post('/program/{id}/edit', 'ProgramController@postEdit');
    Route::get('/program/{id}/edit', 'ProgramController@getEdit');
    Route::post('/program/create', 'ProgramController@postCreate');
    Route::get('/program/create', 'ProgramController@getCreate');
    Route::get('/program', 'ProgramController@getIndex');
    Route::post('/program/lectures/save', 'ProgramController@postLecturesSave');
    Route::post('/program/lectures/update', 'ProgramController@postLecturesEdit');
    Route::post('/program/lectures/delete', 'ProgramController@postLecturesDelete');
    Route::get('/program/{id}/lectures', 'ProgramController@getLectures');


    Route::post('/moderator/{id}/edit', 'ModeratorController@postEdit');
    Route::get('/moderator/{id}/edit', 'ModeratorController@getEdit');
    Route::post('/moderator/create', 'ModeratorController@postCreate');
    Route::get('/moderator/create', 'ModeratorController@getCreate');
    Route::get('/moderator', 'ModeratorController@getIndex');

    Route::post('/panelist/{id}/edit', 'PanelistController@postEdit');
    Route::get('/panelist/{id}/edit', 'PanelistController@getEdit');
    Route::post('/panelist/create', 'PanelistController@postCreate');
    Route::get('/panelist/create', 'PanelistController@getCreate');
    Route::get('/panelist', 'PanelistController@getIndex');

    Route::post('/speaker/{id}/edit', 'SpeakerController@postEdit');
    Route::get('/speaker/{id}/edit', 'SpeakerController@getEdit');
    Route::post('/speaker/create', 'SpeakerController@postCreate');
    Route::get('/speaker/create', 'SpeakerController@getCreate');
    Route::get('/speaker', 'SpeakerController@getIndex');


    Route::post('/slideshow/{id}/edit', 'SlideshowController@postEdit');
    Route::get('/slideshow/{id}/edit', 'SlideshowController@getEdit');
    Route::post('/slideshow/create', 'SlideshowController@postCreate');
    Route::get('/slideshow/create', 'SlideshowController@getCreate');
    Route::get('/slideshow', 'SlideshowController@getIndex');


    Route::get('/faculty/categories', ['uses' => 'FacultyController@categoryList', 'as' => 'faculty.categories']);
    Route::get('/faculty/categories/create', 'FacultyController@categoryCreate');
    Route::post('/faculty/categories/create', 'FacultyController@categorySave');
    Route::get('/faculty/categories/{id}', 'FacultyController@categoryEdit');
    Route::post('/faculty/categories/{id}', 'FacultyController@categoryUpdate');

    Route::post('/faculty/{id}/edit', 'FacultyController@postEdit');
    Route::get('/faculty/{id}/edit', 'FacultyController@getEdit');
    Route::post('/faculty/create', 'FacultyController@postCreate');
    Route::get('/faculty/create', 'FacultyController@getCreate');
    Route::get('/faculty/{id}', 'FacultyController@getInstructor');
    Route::get('/faculty', 'FacultyController@getIndex');
    Route::get('/faculty/{id}/print', 'FacultyController@getPrint');

    // Comittee Category Routes
    Route::get('/committee/categories', ['uses' => 'CommitteeController@categoryList', 'as' => 'committee.categories']);
    Route::get('/committee/categories/create', 'CommitteeController@categoryCreate');
    Route::post('/committee/categories/create', 'CommitteeController@categorySave');
    Route::get('/committee/categories/{id}', 'CommitteeController@categoryEdit');
    Route::post('/committee/categories/{id}', 'CommitteeController@categoryUpdate');
    // End Comittee Category Routes

    // Committee Routes
    Route::post('/committee/{id}/edit', 'CommitteeController@postEdit');
    Route::get('/committee/{id}/edit', 'CommitteeController@getEdit');
    Route::post('/committee/create', 'CommitteeController@postCreate');
    Route::get('/committee/create', 'CommitteeController@getCreate');
    Route::get('/committee/{id}', 'CommitteeController@getMember');
    Route::get('/committee', 'CommitteeController@getIndex');
    // End Committee Routes

    // Case Submission
    Route::get('/case-submission', ['uses' => 'CaseSubmissionController@getIndex', 'as' => 'case-submission.index']);
    Route::get('/case-submission/{id}', ['uses' => 'CaseSubmissionController@getView', 'as' => 'case-submission.view']);
    Route::get('/case-submission/{id}/download', ['uses' => 'CaseSubmissionController@downloadDocument', 'as' => 'case-submission.download']);
    // End Case Submission


    Route::get('/board/countries', ['uses' => 'BoardController@countryList', 'as' => 'board.countries']);
    Route::get('/board/countries/create', 'BoardController@countryCreate');
    Route::post('/board/countries/create', 'BoardController@countrySave');
    Route::get('/board/countries/{id}', 'BoardController@countryEdit');
    Route::post('/board/countries/{id}', 'BoardController@countryUpdate');

    Route::post('/board/{id}/edit', 'BoardController@postEdit');
    Route::get('/board/{id}/edit', 'BoardController@getEdit');
    Route::post('/board/create', 'BoardController@postCreate');
    Route::get('/board/create', 'BoardController@getCreate');
    Route::get('/board/{id}', 'BoardController@getMember');
    Route::get('/board', 'BoardController@getIndex');




    // Route::get('/abstract', 'AbstractController@list');
    // Route::post('/abstract', 'AbstractController@getAbstract');
    // Route::get('/abstract/{id}/download', 'AbstractController@download');

    Route::post('message', ['uses' => 'ContentController@updateMessage', 'as' => 'content.message.update']);
    Route::get('message', ['uses' => 'ContentController@messageForm', 'as' => 'content.message.form']);

    Route::get('/registration', 'ContentController@getRegistration');
    Route::post('/registration', 'ContentController@postRegistration');

    Route::post('/registrations/{id}/edit', 'RegistrationsController@postEdit');
    Route::get('/registrations/{id}/edit', 'RegistrationsController@getEdit');
    Route::get('/registrations/{id}/print', 'RegistrationsController@getPrint');

    Route::get('/registrations/export/downloaders', ['uses' => 'RegistrationsController@exportCertificateDownloaders', 'as' => 'registrations.export.downloaders']);
    Route::get('/registrations/export/attendees', ['uses' => 'RegistrationsController@exportAttendees', 'as' => 'registrations.export.attendees']);
    Route::get('/registrations/export/all', ['uses' => 'RegistrationsController@exportAttendees', 'as' => 'registrations.export.all']);
    Route::get('/registrations/export/workshop/{id}', ['uses' => 'RegistrationsController@exportWorkshop', 'as' => 'registrations.export.workshop']);
    Route::get('/registrations/export/allReg/{workshopId?}', ['uses' => 'RegistrationsController@exportRegistrants', 'as' => 'registrations.export.allReg']);

    Route::post('/registrations/import', 'RegistrationsController@postImport');
    Route::get('/registrations/import', 'RegistrationsController@getImport');
    Route::post('/registrations/create', 'RegistrationsController@postCreate');
    Route::get('/registrations/create', 'RegistrationsController@getCreate');
    Route::get('/registrations', 'RegistrationsController@getRegistrations');

    Route::post('/categories/create', 'CategoriesController@postCreate');
    Route::get('/categories/create', 'CategoriesController@getCreate');
    Route::get('/categories/{id}', 'CategoriesController@getEdit');
    Route::post('/categories/{id}', 'CategoriesController@postEdit');
    Route::get('/categories', 'CategoriesController@getIndex');

    Route::post('/schedule/{id}/edit', 'SessionsController@update');
    Route::get('/schedule/{id}/edit', 'SessionsController@formEdit');
    Route::get('/schedule/{id}', ['uses' => 'AgendaActivitiesController@show', 'as' => 'activities.single']);
    Route::post('/schedule/create', 'SessionsController@create');
    Route::get('/schedule/create', 'SessionsController@intervalForm');

    Route::get('/schedule', 'AdminController@schedule');

    Route::get('/evaluation', 'AdminController@getEvaluation');
    Route::get('/draw', 'AdminController@drawPage');

    Route::post('/ajax/check', 'AjaxController@postCheck');

    Route::post('/ajax/draw', 'AjaxController@getDraw');
    Route::post('/ajax/settings', 'AjaxController@postSettings');
    Route::post('/ajax/delete', 'AjaxController@postDelete');

    Route::get('/logout', 'AdminController@getLogout');
    Route::get('/', 'AdminController@getIndex');

    Route::get('/settings', 'SettingsController@settings');
    Route::post('/settings', 'SettingsController@updateSettings');

    Route::get('/payment-gateway', 'PaymentGatewaysController@index');
    Route::post('/payment-gateway', 'PaymentGatewaysController@update');

    Route::get('/page-content', 'AdminController@pageContent');
    Route::post('/page-content', 'AdminController@updatePageContent');


    Route::get('/registrants-bulk/', 'RegistrantsBulkController@list');
    Route::get('/registrants-bulk/{id}/confirm', 'RegistrantsBulkController@confirm');

    // Sessions
    Route::get('/questions', 'QuestionsController@list');
    // Route::get('/questions/view/{session_id}', 'QuestionsController@view')->name('questions.view');
    Route::post('/questions/get-questions/', 'QuestionsController@getQuestions')->name('questions.get');
    Route::post('/questions/answer-questions/', 'QuestionsController@answerQuestions')->name('questions.answer');

    Route::post('/questions/enable-questions/', 'QuestionsController@enableQuestions')->name('questions.enable');


    /* Exhibitors */
    Route::get('/exhibitors', 'ExhibitorsController@list')->name('exhibitors');
    Route::post('/exhibitors/list', 'ExhibitorsController@getData')->name('exhibitors.list');
    Route::get('/exhibitors/create', 'ExhibitorsController@loadCreate');
    Route::post('/exhibitors/create', 'ExhibitorsController@create')->name('exhibitors.create');
    Route::post('/exhibitors/company/space', 'ExhibitorsController@companySpace')->name('exhibitors.company.space');
    Route::get('/exhibitors/view/{id}', 'ExhibitorsController@view')->name('exhibitors.view');
    Route::get('/exhibitors/print/{id}', 'ExhibitorsController@getPrint')->name('exhibitors.print');
    /* Exhibitors */

    /* Blog */
    Route::get('/blog/posts', 'AdminBlogController@list')->name('blog.posts');
    Route::post('/blog/posts/list', 'AdminBlogController@getData')->name('blog.posts.list');
    Route::get('/blog/post/create', 'AdminBlogController@loadCreate');
    Route::post('/blog/post/create', 'AdminBlogController@create')->name('blog.post.create');
    Route::get('/blog/post/view/{id}', 'AdminBlogController@view')->name('blog.post.view');
    Route::post('/blog/post/view/{id}', 'AdminBlogController@update')->name('blog.post.update');
    Route::delete('/blog/post/delete', 'AdminBlogController@deletePost')->name('blog.post.delete');
    /* Blog */

    /* Logs */
    Route::get('/logs', 'LogsController@index')->name('logs.index');
    Route::get('/logs/{id}', 'LogsController@getDetails')->name('logs.details');
    /* Logs */

    Route::get('mail', 'TestController@index');
    Route::post('mail', 'TestController@save');
});

Route::get('admin/login', 'AdminController@getLogin');
Route::post('admin/login', 'AdminController@postLogin');

// Route::get('/email', 'AbstractController@email');
Route::get('/payment-email', 'GenericPageController@paymentIncomplete');

Route::post('/evaluation', ['uses' => 'RegistrationController@evaluate', 'as' => 'evaluation.post']);
Route::get('/evaluation', ['uses' => 'RegistrationController@evaluationForm', 'as' => 'evaluation.form']);
Route::post('/certificate/verify', ['uses' => 'RegistrationController@verify', 'as' => 'registration.verify']);


Route::group(['middleware' => 'logs'], function () {
    Route::post('/register', ['uses' => 'RegistrationController@create', 'as' => 'registrations.create']);
    Route::post('/login', 'RegistrationController@postLogin');
});

////////// home page register part //////////
Route::get('/register/verify-otp/{id}', 'RegistrationController@otpValidation');
Route::post('/register/verify-otp/{id}', ['uses' => 'RegistrationController@otpVerifyAction', 'as' => 'registrations.otpVerify']);
Route::post('/register/update-phone-number/{id}', ['uses' => 'RegistrationController@updatePhoneNumber', 'as' => 'registrations.updatePhoneNumber']);
Route::get('/register/resend-otp-code/{id}', 'RegistrationController@resendOtpCode');

Route::get('/login', 'RegistrationController@login')->name('login');    
Route::get('/register/payment/{id}', 'RegistrationController@paymentValidation');
Route::get('/register/{slot}/{registration_id?}', 'RegistrationController@paymentResult');
Route::post('/register/{slot}/{registration_id?}/print', 'RegistrationController@printPaymentResult');
Route::get('/register/complete-payment/{id}', 'RegistrationController@completeFailedPayment');
////////// home page register part //////////

////// login and watch-live part //////
Route::get('/logout', 'RegistrationController@logout');
Route::get('/watch-live', 'RegistrationController@watchLive')->middleware('auth:web');
Route::post('/watch-live', 'RegistrationController@sendQuestion')->middleware('auth:web');
Route::post('/refresh-session', 'RegistrationController@fetchCurrentAndNextSession')->middleware('auth:web');
////// login and watch-live part //////


/* Blog */
// Route::get('/blog/{word?}', 'BlogController@index')->name('pages.blog');
// Route::get('/post/{slug}', 'BlogController@detail')->name('pages.blog/detail');
// Route::post('/blog/like-a-post', 'BlogController@likePost')->name('pages.likePost');
/* Blog */

/* Case Submission */
// Route::get('/case-submission', ['uses' => 'GenericPageController@caseSubmission', 'as' => 'pages.case-submission']);
// Route::post('/case-submission', ['uses' => 'GenericPageController@submitCaseSubmission']);
/* Case Submission */

/* Sponsors */
Route::get('/sponsors', ['uses' => 'GenericPageController@sponsors', 'as' => 'pages.sponsors']);
/* Sponsors */

/* Contact Us */
Route::get('/contact-us', ['uses' => 'GenericPageController@contactUs', 'as' => 'pages.contact-us']);
/* Contact Us */

/* Committees */
Route::get('/committees', ['uses' => 'GenericPageController@committees', 'as' => 'pages.committees']);
/* Committees */

Route::get('/program', ['uses' => 'GenericPageController@program', 'as' => 'pages.program']);
Route::get('/program/download/pdf', ['uses' => 'GenericPageController@downloadProgramPDF', 'as' => 'downloadProgramPDF']);

Route::post('emails/create', ['uses' => 'GenericPageController@createEmail', 'as' => 'emails.create']);
Route::get('/registration', ['uses' => 'GenericPageController@registration', 'as' => 'pages.registration']);
Route::get('/register', ['uses' => 'GenericPageController@register', 'as' => 'pages.register']);
Route::get('/venue', ['uses' => 'GenericPageController@venue', 'as' => 'pages.venue']);
Route::get('/faculty', ['uses' => 'GenericPageController@faculty', 'as' => 'pages.faculty']);
Route::post('/faculty/members', ['uses' => 'GenericPageController@getMembers', 'as' => 'pages.faculty-members']);
Route::post('/faculty', ['uses' => 'GenericPageController@facultyBio', 'as' => 'pages.faculty-bio']);
Route::get('/terms-and-conditions', ['uses' => 'GenericPageController@termsConditions', 'as' => 'pages.terms-and-conditions']);
Route::get('/sessions', ['uses' => 'GenericPageController@sessions', 'as' => 'pages.sessions']);
Route::get('/past-meetings', ['uses' => 'GenericPageController@pastMeetings', 'as' => 'pages.past-meetings']);
Route::get('/test', ['uses' => 'GenericPageController@test', 'as' => 'pages.test']);
Route::get('/', ['uses' => 'GenericPageController@getIndex', 'as' => 'pages.index']);
Route::get('/location', ['uses' => 'GenericPageController@location', 'as' => 'pages.location']);
// Route::get('/abstracts', ['uses' => 'GenericPageController@abstract', 'as' => 'pages.abstract']);
// Route::get('/abstracts/download/template', ['uses' => 'GenericPageController@abstractTemplate']);
// Route::post('/abstracts', ['uses' => 'GenericPageController@saveAbstract', 'as' => 'pages.saveAbstract']);
Route::get('/about', ['uses' => 'GenericPageController@about', 'as' => 'pages.about']);
Route::get('/cme', ['uses' => 'GenericPageController@cme', 'as' => 'pages.cme']);

// Forward
Route::get('/bulk', ['uses' => 'GenericPageController@registrants', 'as' => 'pages.registrants']);
Route::get('/bulk/download/template', ['uses' => 'GenericPageController@registrantsTemplate']);
Route::post('/bulk', ['uses' => 'GenericPageController@saveRegistraion', 'as' => 'pages.saveRegistrants']);

Route::get('/exhibitors', ['uses' => 'GenericPageController@exhibitors', 'as' => 'pages.exhibitors']);
Route::post('/exhibitors', ['uses' => 'GenericPageController@saveExhibitors', 'as' => 'pages.saveExhibitors']);

Route::post('password', 'GenericPageController@passwordCheck');



// Route::get('test/virtual', 'TestController@sendSteps');
// Route::get('test/cert', 'TestController@cert');
Route::get('test/howtocert', 'TestController@howtocert');
// Route::get('test/delete', 'TestController@delete');
// Route::get('test/mail', 'TestController@mail');