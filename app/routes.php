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


Route::get('/', function()
{
	if (!empty($_GET) && $_GET['Login'] && $_GET['Password']) {		
		
		if(Hackaton\Auth::login($_GET['Login'], $_GET['Password']))
			return Redirect::to('view');
	}  elseif (Hackaton\Auth::auth())  {
		return Redirect::to('view');
	}

	return View::make('hello');	
});

Route::get('logout', function()
{
	Hackaton\Auth::logout();
	return Redirect::to('/');
});



Route::get('view', function()
{
	if (Hackaton\Auth::auth())
		return View::make('list');
	else 
		return Redirect::to('/');	
});



Route::controller('list', 'ListController');

Route::controller('element', 'ElementController');

Route::controller('autocomplite', 'AutocompliteController');

Route::get('test', 'TestController@index');