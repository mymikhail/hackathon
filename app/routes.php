<?php

require __DIR__ . '/config/database.php';
require_once __DIR__ . '/extentions/Auth.php';
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', function()
{
	if (!empty($_GET) && $_GET['Login'] && $_GET['Password']) {		
		$r = Hackaton\Auth::auth($_GET['Login'], $_GET['Password']);
		if($r)
			return Redirect::to('view');	
	} 

	return View::make('hello');	
});


Route::get('view', function()
{
	return View::make('list');
});


Route::filter('basic.once', function () {
  return Auth::onceBasic();
});


Route::get('view', array('before' => 'basic.once', function()
{
    return 'You are over 200 years old!';
}));
*/

Route::get('/', function()
{
	return View::make('list');
});

Route::controller('list', 'ListController');

Route::controller('element', 'ElementController');

Route::controller('autocomplite', 'AutocompliteController');

Route::get('test', 'TestController@index');