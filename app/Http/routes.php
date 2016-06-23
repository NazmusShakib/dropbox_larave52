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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('link');
});

Route::get('link/redirect/{provider}', 'DropCtrl@redirectToProvider');
Route::get('link/{provider}', 'DropCtrl@handleProviderCallback');
Route::get('info', 'DropCtrl@view_details');


Route::get('download',array('uses'=>'DropCtrl@download','as'=>'download'));

/*Route::post('download', [
    'as' => 'download', 'uses' => 'DropCtrl@download'
]);*/

Route::post('upload', 'DropCtrl@upload_to_dropbox');
//Route::get('download', 'DropCtrl@download_from_dropbox');
Route::get('down', 'DropCtrl@downloadFile');
Route::get('do', 'DropCtrl@getFile');