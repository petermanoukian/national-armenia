<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Models\Cat;
use App\Models\Prod;
use App\Models\Subcat;
use App\Models\Banner;
use App\Models\Tagg;
use App\Models\Gal;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
		return view('appadmin.home');
    }
	
	public function indexpublic()
    {
        $homenews1 =Prod::with(['cat'])->with(['sub'])->
		where('layerr', '=', '1')->limit(4)->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		
		$cathomelay2singles = Cat::where('layerr', '=', '1')	
		->skip(0)->take(1)
		->orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->get();
		
		$cathomelay2singles2 = Cat::where('layerr', '=', '2')	
		->skip(0)->take(1)
		->orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->get();
		
		$cathomelay2singles3 = Cat::where('layerr', '=', '3')	
		->skip(0)->take(1)
		->orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->get();
		
		
		$homebannerlay1 = Banner::where('posx', '=' , '2')->where('typ', '=' , 'banner')->first();
		$homebannerlay2 = Banner::where('posx', '=' , '3')->where('typ', '=' , 'banner')->first();
		
		$innerbayer1= Banner::where('posx', '=' , '1')->where('typ', '=' , 'banner')->first();
		
		return view('welcome' , compact( 'homenews1', 'homebannerlay1' , 
		'homebannerlay2' ,  'cathomelay2singles', 
		'cathomelay2singles2', 'cathomelay2singles3' , 'innerbayer1'));
    }
	
}
