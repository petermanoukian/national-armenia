<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\SubcatController;
use App\Http\Controllers\ProdController;
use App\Http\Controllers\GalController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BannerController; 
use App\Http\Controllers\TaggController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\PagController;
use App\Http\Controllers\ContactController;



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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function ($router) 
{
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::post('me', 'AuthController@me');
});


Route::get('/catnav', [App\Http\Controllers\CatController::class, 'catnav'])->name('homecatnav')->middleware('cors');
Route::get('/prodban', [App\Http\Controllers\ProdController::class, 'prodbanner'])->name('homeprodban')->middleware('cors');
Route::get('/homecat1', [App\Http\Controllers\ProdController::class, 'cathome1'])->name('cathome1')->middleware('cors');
Route::get('/homecat2', [App\Http\Controllers\ProdController::class, 'cathome2'])->name('cathome2')->middleware('cors');

Route::get('/prodhomelayer1', [App\Http\Controllers\ProdController::class, 'prodhomelayer1'])->name('prodhomelayer1')->middleware('cors');
Route::get('/prodhomelayer2', [App\Http\Controllers\ProdController::class, 'prodhomelayer2'])->name('prodhomelayer2')->middleware('cors');

Route::get('/politicsjson/{catid?}/{cat?}/{subid?}/{sub?}/', [ProdController::class, 'indexjson'])->name('politcaljson')->middleware('cors');
Route::get('/politicdetailjson/{id}/{title?}/{cat?}/{sub?}/', [ProdController::class, 'detailapi'])->name('detailapi')->middleware('cors');
Route::get('/politicstagjson/{tag?}/', [ProdController::class, 'indextagjson'])->name('politicstagjson')->middleware('cors');




Route::get('/bannerhomelayer1', [App\Http\Controllers\BannerController::class, 'bannerlayer1json'])->name('bannerlayer1json')->middleware('cors');
Route::get('/bannerhomelayer2', [App\Http\Controllers\BannerController::class, 'bannerlayer2json'])->name('bannerlayer2json')->middleware('cors');
Route::get('/homevideos1', [App\Http\Controllers\VideoController::class, 'homevideos1'])->name('homevideos1')->middleware('cors');
Route::get('/prodrightlayer3', [App\Http\Controllers\ProdController::class, 'prodrightlayer3'])->name('prodrightlayer3')->middleware('cors');
Route::get('/prodrightlayer1trend', [App\Http\Controllers\ProdController::class, 'prodrightlayer1trend'])->name('prodrightlayer1trend')->middleware('cors');
Route::get('/bannerrightlayer3', [App\Http\Controllers\BannerController::class, 'bannerlayer3json'])->name('bannerrightlayer3')->middleware('cors');
Route::get('/bannerrightlayer4', [App\Http\Controllers\BannerController::class, 'bannerlayer4json'])->name('bannerrightlayer4')->middleware('cors');
Route::get('/bannerrightlayer5', [App\Http\Controllers\BannerController::class, 'bannerlayer5json'])->name('bannerrightlayer5')->middleware('cors');

Route::get('/videorightbylayer/{layer}', [App\Http\Controllers\VideoController::class, 'videorightbylayer'])->name('videorightbylayer')->middleware('cors');

Route::get('/tagright1', [App\Http\Controllers\ProdController::class, 'tagright'])->name('tagright1')->middleware('cors');

Route::get('/prodsearch/search2', [App\Http\Controllers\ProdController::class, 'search2'])->name('rightnewnamesearch2')->middleware('cors');
Route::post('/prodsearch/search2', [App\Http\Controllers\ProdController::class, 'search2'])->name('rightnewnamesearch2')->middleware('cors');

Route::get('/prodsearch/search', [App\Http\Controllers\ProdController::class, 'search'])->name('rightnewnamesearch')->middleware('cors');
Route::post('/prodsearch/search', [App\Http\Controllers\ProdController::class, 'search'])->name('rightnewnamesearch')->middleware('cors');


Route::get('/linkjson/', [BannerController::class, 'indexjson'])->name('linkjson')->middleware('cors');
Route::get('/videojson/', [VideoController::class, 'indexjson'])->name('videojson')->middleware('cors');





Route::post('/contacter', [App\Http\Controllers\ContactController::class, 'store'])->name('contact1')->middleware('cors');
Route::post('/contacterattach', [App\Http\Controllers\ContactController::class, 'storeattach'])->name('contact1attach')->middleware('cors');









//Route::post('/contacter/', 'ContactController@store');