<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Models\Resume;

Route::get('/', function () {

	$resume = Resume::with('jobs')->find(1);

    return view('resumes.resume');
});

Route::post('/resume', function(){
	return Resume::with('jobs')->find(1)->jobs;
});
