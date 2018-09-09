
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

Route::get('/imports',['as' => 'import_page', 'uses' => 'OnlyController@import']);


Route::get('/get_import', ['as' => 'perform_import', 'uses' => '\App\Http\Functions\ImportFunction@import']);
Route::get('/refresh',['as' => 'import_page', 'uses' => '\App\Http\Functions\ImportFunction@refresh_db']);
Route::get('/search', ['as' => 'perform_import', 'uses' => '\App\Http\Functions\SearchFunction@search']);

Route::get('/{product}', ['as'=> 'product.show', 'uses'=>'OnlyController@show']);
