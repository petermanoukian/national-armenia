<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Cat;
use App\Models\Subcat;
use App\Models\Prod;
use App\Models\Video;
use App\Models\Banner;
use App\Models\Tagg;
use App\Models\Gal;
use View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		$cathomelay1 = Cat::with((['subs']))->withCount('subs')->where('homer', '=', 'yes')->limit(10)->
		orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->get();
		
		$newhomelay1 = Prod::with(['cat'])->with(['sub'])->where('homer', '=', 'yes')->limit(10)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		
		$newhomelay2 = Prod::with(['cat'])->with(['sub'])->where('layerr', '=', '2')->limit(10)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		
		$newhomelay3 = Prod::with(['cat'])->with(['sub'])->where('homer2', '=', 'yes')->limit(4)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		
		
		$newhomelay4 = Prod::with(['cat'])->with(['sub'])->limit(4)->orderBy('prods.id', 'DESC')->get();
		
		$homebannerlay3 = Banner::where('posx', '=' , '4')->where('typ', '=' , 'banner')->first();
		$homebannerlay5 = Banner::where('posx', '=' , '5')->where('typ', '=' , 'banner')->first();
		
		$homebannerlay6 = Banner::where('posx', '=' , '6')->where('typ', '=' , 'banner')->first();
		$homebannerlay7 = Banner::where('posx', '=' , '7')->where('typ', '=' , 'banner')->first();
		
		
		$vidrightsingle1 = Video::where('layerr', '=', '1')	
		->orderBy('id', 'DESC')->limit(1)->get();
		
		$vidrightsingle2 = Video::where('layerr', '=', '2')	
		->orderBy('id', 'DESC')->limit(1)->get();
		
		$vidrightsingle3 = Video::where('layerr', '=', '3')	
		->orderBy('id', 'DESC')->limit(1)->get();
		
		$tagghomelay1 = Tagg::limit(20)->orderBy('name', 'ASC')->get();
		
		$cathomelays2 = Cat::limit(30)->
		orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->get();
		
		$subhomelays = Subcat::with(['catsubb'])->limit(30)->
		orderBy('subcats.catid', 'DESC')->orderBy('subcats.id', 'DESC')->get();
		
		
		$homegals = Gal::limit(30)->
		orderBy('gals.prodid', 'DESC')->orderBy('gals.id', 'DESC')->get();
		
		$appvars = array(
			'menucathomes' => $cathomelay1,
			'cathomelays2' => $cathomelays2,
			'subhomelays' => $subhomelays,
			'newhomelays' => $newhomelay1,
			'newhomelays2' => $newhomelay2,
			'newhomelays3' => $newhomelay3,
			'newhomelays4' => $newhomelay4,
			'vidrightsingle1' => $vidrightsingle1,
			'vidrightsingle2' => $vidrightsingle2,
			'vidrightsingle3' => $vidrightsingle3,
			'homebannerlay3' => $homebannerlay3,
			'homebannerlay5' => $homebannerlay5,
			'homebannerlay6' => $homebannerlay6,
			'homebannerlay7' => $homebannerlay7,
			'tagghomelays1' => $tagghomelay1,
			'homegals' => $homegals,
		);
		View::share('appvars', $appvars);
        //View::share('menucathomes',compact('cathomelay1', 'newhomelay1'));
		
		Paginator::useBootstrap();
		
		
    }
}
