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
use App\Models\Item;
use Illuminate\Http\Request;

Route::get('/', function () {

	//$resume = Resume::with('items')->find(1);
	//
	$resumeId = 1;

    return view('resumes.resume', compact('resumeId'));
});

Route::get('word', function() {
	return view('word');
});

Route::post('/resume', function(Request $request){

	$resumeId = $request->resume_id;

	return Resume::with('items')->find($resumeId)->items;
});

Route::post('/job-add', function(Request $request){

	$job = $request->item;

	return Item::create($job);

	
});

Route::post('/edit-item', function(Request $request){

	$id = $request->id;

	return Item::find($id);
	
	
});
