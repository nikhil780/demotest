<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

	//Route::group(['prefix' => 'api', 'middleware' => 'cors'], function () {
//Route::middleware(['ApiDataLogger'])->group(function () {

		dd('21');
	   /// API for WEB START ///////////////////////////

		Route::post('web/get_users', 'Api\ExampleController@index');

		// Route::post('web/login_student', 'Api\ApiwebController@login_student');	
		// Route::post('web/calender', 'Api\ApiwebController@calender');	
		// Route::post('web/assignment_list', 'Api\ApiwebController@assignment_list');
		// Route::post('web/assignment_detail', 'Api\ApiwebController@assignment_detail');	
  //       Route::post('web/announcement_list', 'Api\ApiwebController@announcement_list');
  //       Route::post('web/announcement_detail', 'Api\ApiwebController@announcement_detail');	

		// Route::post('web/add_comment', 'Api\ApiwebController@add_comment');
		// Route::post('web/submit_assignment', 'Api\ApiwebController@submit_assignment');
		// Route::post('web/update_info', 'Api\ApiwebController@update_credentials');
		// Route::post('web/update_profile', 'Api\ApiwebController@update_profile');
		// //Route::post('/login_student', 'Api\ApiwebController@login_student');
		// Route::post('web/get_subjects', 'Api\ApiwebController@get_subjects');
		// //Route::post('web/get_subjects_new', 'Api\ApiwebController@get_subjects_new');
		// Route::post('web/get_subjects_topics', 'Api\ApiwebController@get_subjects_topics');
		// Route::post('web/resetpassword', 'Api\ApiwebController@resetpassword'); 
		// Route::post('web/mark_attendance', 'Api\ApiwebController@mark_attendance');
		// Route::post('web/show_profile', 'Api\ApiwebController@show_profile');


		// Route::post('web/get_quiz', 'Api\ApiwebController@get_quiz');
		
		// Route::post('web/get_exam_subjects', 'Api\ApiwebController@get_exam_subjects');
		// Route::post('web/get_exam_results', 'Api\ApiwebController@get_exam_results');
		// Route::post('web/get_exam_data', 'Api\ApiwebController@get_exam_data');
		// Route::post('web/start_exams', 'Api\ApiwebController@start_exams');
		// Route::post('web/final_submit_exams', 'Api\ApiwebController@final_submit_exams');
		// Route::post('web/quiz_attempt_save', 'Api\ApiwebController@quiz_attempt_save');
		// Route::post('web/submit_exam_show_result', 'Api\ApiwebController@submit_exam_show_result');
		// Route::post('web/meeting_list', 'Api\ApiwebController@meeting_list');
		
		

		 /// API for WEB ENF ///////////////////////////


		// Route::post('/checklogin', 'Api\AuthController@login');
		// Route::post('/chk_student', 'Api\ApiController@chk_student');
		// Route::post('/login_student', 'Api\ApiController@login_student');	



		//ApiControllerTest
		// API for testing ========== START ============================

		/*Route::post('/login_student1', 'Api\ApiControllerTest@login_student');
		Route::post('/get_subjects1', 'Api\ApiControllerTest@get_subjects');
		Route::post('/get_subjects_topics1', 'Api\ApiControllerTest@get_subjects_topics');
		Route::post('/mark_attendance1', 'Api\ApiControllerTest@mark_attendance');
		Route::post('/show_profile1', 'Api\ApiControllerTest@show_profile');
		Route::post('/calender1', 'Api\ApiControllerTest@calender');*/
		// API for testing ========== END ============================
		//Route::post('/login_student', 'Api\AuthController@login_student');
	// 	Route::post('/calender', 'Api\ApiController@calender');
	// 	//Route::post('/assignment_detail', 'Api\ApiController@assignment_detail');
	// 	Route::post('/assignment_list', 'Api\ApiController@assignment_list');

		


	// 	Route::post('/assignment_detail', 'Api\ApiController@assignment_detail');		
	// 	Route::post('/add_comment', 'Api\ApiController@add_comment');
	// 	Route::post('/submit_assignment', 'Api\ApiController@submit_assignment');

	// 	 Route::post('announcement_list', 'Api\ApiController@announcement_list');
 //        Route::post('announcement_detail', 'Api\ApiController@announcement_detail');	

	// 	Route::post('/update_info', 'Api\ApiController@update_credentials');
	// 	Route::post('/update_profile', 'Api\ApiController@update_profile');
	// 	//Route::post('/login_student', 'Api\ApiController@login_student');
	// 	Route::post('/get_subjects', 'Api\ApiController@get_subjects');
	// 	Route::post('/get_subjects_new', 'Api\ApiController@get_subjects_new');
	// 	Route::post('/get_subjects_topics', 'Api\ApiController@get_subjects_topics');
	// 	Route::post('/get_subjects_topics_stream', 'Api\ApiController@get_subjects_topics_stream');
		
	// 	Route::post('/resetpassword', 'Api\ApiController@resetpassword'); //first time login reset pwd
	// 	Route::post('/mark_attendance', 'Api\ApiController@mark_attendance');
	// 	Route::post('/show_profile', 'Api\ApiController@show_profile');

	// 	Route::post('/get_exam_subjects', 'Api\ApiController@get_exam_subjects');
	// 	Route::post('/get_exam_data', 'Api\ApiController@get_exam_data');
	// 	Route::post('/start_exams', 'Api\ApiController@start_exams');
	// 	Route::post('/final_submit_exams', 'Api\ApiController@final_submit_exams');
	// 	Route::post('/quiz_attempt_save', 'Api\ApiController@quiz_attempt_save');
	// 	Route::post('/meeting_list', 'Api\ApiController@meeting_list');		


	// Route::middleware('auth:passportapi')->group(function () {
	// });

//});
/*Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

});*/
