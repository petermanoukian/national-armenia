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


Route::get('/config-cache', function() {
    $exitCode = \Artisan::call('config:cache');
    $exitCode = \Artisan::call('cache:clear');
    $exitCode = \Artisan::call('route:clear');
    $exitCode = \Artisan::call('view:clear');
	$exitCode = \Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});



Route::get('/', [App\Http\Controllers\PagController::class, 'index'])->name('homepublic');
Route::get('/index/', [App\Http\Controllers\PagController::class, 'index'])->name('homepublicc');
Route::get('/home/', [App\Http\Controllers\PagController::class, 'index'])->name('homepubliccc');



Route::get('/Armenian-FreeLance-Web-Developer-Lebanese-Website-Development', [ProdController::class, 'index'])->name('Contact.route');
Route::get('/about', [ProdController::class, 'index'])->name('Aboutt.route');
Route::get('/Armenian-blog-Lebanese-politics/Nationalism/Socialism/Social-Justice/', [ProdController::class, 'index'])->name('About.route');
Route::get('/video', [ProdController::class, 'index'])->name('Videos.route');
Route::get('/links', [ProdController::class, 'index'])->name('Linkk.route');

Route::post('/contactus', [ProdController::class, 'index'])->name('Contactus.route');
Route::get('/ArmenianBlog/', [ProdController::class, 'index'])->name('homepublicblog');
Route::get('/Web-Development-FreeLance-Lebanese-Web-Developer-Website-SEO/', [ProdController::class, 'index'])->name('Service.route');
Route::get('/Lebanese/Armenian/Freelance/PHP/Web/Developer/Website/Development/Armenia/Lebanon', [ProdController::class, 'index'])->name('webdevelopment.route');


Route::get('/political/{catid?}/{cat?}/{subid?}/{sub?}/', [ProdController::class, 'index'])->name('News.route');
Route::get('/politicaltag/{tag}', [ProdController::class, 'index'])->name('News.route');
Route::get('/politicaldetail/{id}/{title?}/{cat?}/{sub?}/', [ProdController::class, 'index'])->name('NewsDetail.route');
Route::get('/politicalsearch', [ProdController::class, 'index'])->name('NewsSearch.route');
Route::post('/politicalsearch', [ProdController::class, 'index'])->name('NewsSearch.route');
Route::get('/autocomplete', [ProdController::class, 'autocomplete'])->name('autocomplete');




Route::get('/rss-feed', [ProdController::class, 'rssFeed'])->name('rssFeed');
Route::get('/refresh_captcha', [ProdController::class, 'refreshCaptcha'])->name('refresh_captcha');;













//Route::post('/contacter/', ['middleware' => ['cors']  ,'uses' =>'ContactController@store']);



