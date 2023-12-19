<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\Cat;
use App\Models\Prod;
use App\Models\Subcat;

use DataTables;
use Image;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;

use App;
use App\Models\Banner;
use App\Models\Tagg;
use App\Models\Gal;
use Illuminate\Support\Facades\Session;



class ProdController extends Controller
{
    
	public function indexadmin(Request $request , $catid ='' , $subid ='')
	{
		$this->middleware(['auth']);
		
		$sess = session_id();
		$token =  $request->session()->token();
		if ($request->ajax()) {
			
			if($catid != '' && $catid != 0)
			{
				if($subid != '' && $subid != 0)
				{
					$data =Prod::with(['cat'])->with(['sub'])->where('prods.catid', '=', $catid)->where('prods.subid', '=', $subid)->orderBy('prods.id', 'DESC')->get();
				}
				else
				{
					$data =Prod::with(['cat'])->with(['sub'])->where('prods.catid', '=', $catid)->orderBy('prods.id', 'DESC')->get();
				}
			}
			else 
			$data =Prod::with(['cat'])->with(['sub'])->orderBy('prods.id', 'DESC')->get();

			return Datatables::of($data)
			->addIndexColumn()
			
			->addColumn('Delete1', function($row) use ($token){
				$id = $row['id'];
				$name = $row['name'];
				$btn1 = "<input type = 'checkbox' name = 'idx[]' value = \"$id\">";
				return $btn1;
			})
			->addColumn('action', function($row)  use ($token) {
				$id = $row['id'];
				$catid = $row['catid'];
				$subid = $row['subid'];
				$name = $row['name'];
				$btn = "<div style = 'display:inline;float:left;margin-left:5px;'>
							<form method = 'post' action = \"/appadmin/prod/delete/$id/\">
							".csrf_field(). method_field('DELETE') ."
							<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
							<input type=\"hidden\" name=\"_token\" value=\"$token\">
							<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
							class=\"btn btn-danger\">
							</form>
						</div>

						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/editprod/$id/$catid/$subid\" class=\"edit btn btn-primary btn-sm\">Edit </a>	
						</div>
				
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/addgal/$id\" class=\"edit btn btn-primary btn-sm\">
							Add Images </a>	
						</div>
						<br><br>						
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/viewgal/$id\" class=\"edit btn btn-primary btn-sm\">
							View Images </a>	
						</div>";
				return $btn;
			})
			->addColumn('Cat', function($row)
			{
				$cat = $row['cat']['name'];
				return $cat;
			})
			->addColumn('Sub', function($row)
			{
				$subid = $row['subid'];
				if($subid != "" && $subid != "0")
				{
					$sub = $row['sub']['name'];
				}
				else
					$sub = " NA ";
				return $sub;
			})
			->addColumn('IMG', function($row)
			{
				$prodimg = $row['img'];
				$path = env('APP_URL');
				$prodimg1 = $path."images/news/thumb/$prodimg";
				$img = "<img src=\"$prodimg1\" style='max-width:100px;'/>";
				return $img;
			})
			->rawColumns(array("action","Cat","Sub",'Delete1','IMG'))
			->make(true);
        }
		return view('appadmin.viewprod' , compact( 'catid' ,'subid'));
	}
	
	public function edit($id , $catid, $subid)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		$cats = Cat::orderBy('name', 'ASC')->get();
		$subs = Subcat::orderBy('name', 'ASC')->get();

		$row = Prod::where('prods.id', '=', $id)->first();
		//return view('appadmin.editnew', compact('row','cats' , 'vids' , 'tag'));
		return view('appadmin.editprod', compact('row','cats','subs','catid','subid'));
	}
	

	public function create($catid =''  , $subid ='')
    {
        $this->middleware(['auth']);
		$userid = Auth::id();
		$cats = Cat::orderBy('name', 'ASC')->get();
		$subs = Subcat::orderBy('name', 'ASC')->get();
		//$vids = Videor::orderBy('id', 'DESC')->limit(10)->get();
		//return view('appadmin.addnew', compact('cats' , 'vids' , 'catid'));
		return view('appadmin.addprod', compact('cats' , 'subs', 'catid', 'subid'));	
    }
	

	public function store(Request $request)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required' ,   'catid' => 'required' ]);
		$userid = Auth::id();
		
		$tagg =  $request->tagg;
		$name =  $request->name;
		$des = $request->des;
		$dater = $request->dater;
		$dess = $request->dess;
		$ordx = $request->ordx;
		$video = $request->video;
		$keywordd = $request->keywordd;
		$lang = $request->lang;
		$title = $request->title;
		$metades = $request->metades;
		if($title == '')
		{
			$title = $name;
		}
		$title = str_replace(' ','-', $title);

		if($request->file('img'))
        {
			$file = $request->file('img');
			//$imageName = time().'.'.$request->img->extension(); 
			$random = substr(number_format(time() * rand(),0,'',''),0,3);
			$imageName = $title.'-'.$random.'.'.$request->img->extension(); 
			$destinationPath = public_path().'/images/news/thumb';
	
			$img = Image::make($file->path());
			$img->resize(180, 180, function ($constraint) {
			$constraint->aspectRatio();
			})->save($destinationPath.'/'.$imageName);
			
			
			$destinationPath2 = public_path().'/images/news/medium';
			$img2 = Image::make($file->path());
			$img2->resize(400, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath2.'/'.$imageName);

			$imgx = Image::make($file->path());

			$destinationPath1 = public_path().'/images/news';
			$width = 1200; 
			$height = 700; 
			
			$w1 = $imgx->width();
			$h1 = $imgx->height();

			if($h1 > 700 ||  $w1 > 1200 )
			{				
				if($w1 > $h1) 
				{
					$imgx->resize(1200, null, function ($constraint) {
						$constraint->aspectRatio();
					})->save($destinationPath1.'/'.$imageName);
				} 
				else 
				{
					$imgx->resize(null, 700, function ($constraint) {
						$constraint->aspectRatio();
					})->save($destinationPath1.'/'.$imageName);
				}
			}
			else
			{	
				$request->img->move(public_path().'/images/news/', $imageName);
			}
        }
		else
		$imageName = $request->pic;


		try
		{
			$catid = $request->catid;
			$subid = $request->subid;	
			if($subid == '')
			{
				$subid = 0;
			}
			try
			{
				$in =Prod::create(['name' => "$name" ,'catid' => "$catid" ,'subid' => "$subid" ,
				'des' => "$des" , 'dess' => "$dess" , 'ordx' => $ordx ,
				'img' => "$imageName" ,  'title' => $title ,   'tagg' => $tagg , 
				'lang' => "$lang" , 'lang' => "$lang" , 'video' => $video ,
				'keywordd' => "$keywordd" ,'metades' => "$metades" ,'dater' => "$dater"
				,'homer' => $request->homer , 'homer2' => $request->homer2 , 'layerr' => $request->layerr
				]);
				$in->save();
				$LastInsertId = $in->id;
				return Redirect::route('ViewAdminProd.route' ); 				
			}
			catch (\Exception $e) 
			{
				$message =  $e->getMessage();
				echo " issue : $message ";
			}

		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
			echo "message $message ";	
		}	
	}


	public function update(Request $request, $id)
	{

		$this->middleware(['auth']);	
		$catid = $request->catid;
		$subid = $request->subid;
		if($subid == '')
		{
			$subid = 0;
		}
		$tagg =  $request->tagg;
		$name =  $request->name;
		$des = $request->des;
		$dess = $request->dess;
		$ordx = $request->ordx;
		$video = $request->video;
		$keywordd = $request->keywordd;
		$lang = $request->lang;
		$title = $request->title;
		$metades = $request->metades;
		$dater = $request->dater;
		
		if($title == '')
		{
			$title = $name;
		}
		$title = str_replace(' ','-', $title);

		try
		{
			if($request->file('img'))
			{
				$file = $request->file('img');
				//$imageName = time().'.'.$request->img->extension(); 
				$random = substr(number_format(time() * rand(),0,'',''),0,3);
				$imageName = $title.'-'.$random.'.'.$request->img->extension(); 

				$destinationPath = public_path().'/images/news/thumb';
		
				$img = Image::make($file->path());
				$img->resize(180, 180, function ($constraint) {
				$constraint->aspectRatio();
				})->save($destinationPath.'/'.$imageName);
				
				
				$destinationPath2 = public_path().'/images/news/medium';
				$img2 = Image::make($file->path());
				$img2->resize(400, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPath2.'/'.$imageName);

				$imgx = Image::make($file->path());

				$destinationPath1 = public_path().'/images/news';
				$width = 1200; 
				$height = 700; 
				
				$w1 = $imgx->width();
				$h1 = $imgx->height();

				if($h1 > 700 ||  $w1 > 1200 )
				{				
					if($w1 > $h1) 
					{
						$imgx->resize(1200, null, function ($constraint) {
							$constraint->aspectRatio();
						})->save($destinationPath1.'/'.$imageName);
					} 
					else 
					{
						$imgx->resize(null, 700, function ($constraint) {
							$constraint->aspectRatio();
						})->save($destinationPath1.'/'.$imageName);
					}
				}
				else
				{	
					$request->img->move(public_path().'/images/news/', $imageName);
				}
			}
			else
			$imageName = $request->pic;

			$row =Prod::where('prods.id', '=', $id)->first();
			$row->update(['name' => "$name" ,'catid' => "$catid" ,'subid' => "$subid" ,
				'des' => "$des" , 'dess' => "$dess" , 'ordx' => $ordx ,
				'img' => "$imageName" ,  'title' => $title , 'tagg' => $tagg , 
				'lang' => "$lang" , 'lang' => "$lang" , 'video' => $video ,
				'keywordd' => "$keywordd" ,'metades' => "$metades" ,'dater' => "$dater"
				,'homer' => $request->homer , 'homer2' => $request->homer2 ,
				'layerr' => $request->layerr
				]);
			
			$LastInsertId = $id;
			
		
			/*
			DB::table('tagnews')->where('newsid', '=', "$id")->delete();
	
			$tagg = $request->tagg;
			
			$tagg = str_replace(',,',',', $tagg);
			
			$tagg1 = explode(',', $tagg);
			if(isset($tagg))
			{
				foreach($tagg1 as $tg)
				{
					$tg = trim($tg);
					
					$tgx =Tag::where('tags.title', '=', $tg)->first();
					if($tgx != "")
					{
						$tgid = $tgx->id;
						//echo " Found $tgid $tg ";
					}
					else
					{
						$tgid1 = Tag::create(array('title' => "$tg"));
						$tgid = $tgid1->id;
						//echo " Inserted $tgid $tg ";
					}
					$ing2 = DB::table('tagnews')->insert(
					['tagid' => "$tgid" , 'newsid' => "$LastInsertId"]
					);
				}
			}
			
			*/
			return Redirect::route('ViewAdminProd.route' ); 
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
			echo " MM $message "; 
		}
		
	}	
	

	
	public function destroy($id)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		$prod =Prod::with('gals')->where('prods.id', '=', $id)->first();
		$prod->gals()->delete();
		$prod->delete();
		return Redirect::route('ViewAdminProd.route' ); 
	}
	
	public function destroyall(Request $request)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		if($request->idx && is_array($request->idx))
		{
			foreach($request->idx as $id)
			{
				$prod =Prod::with('gals')->where('prods.id', '=', $id)->first();
				$prod->gals()->delete();
				$prod->delete();
			}
		}
		return Redirect::route('ViewAdminProd.route' ); 
	}


	 public function autocomplete(Request $request)
    {
        $data = Prod::select("name")
                ->where("name","LIKE","%{$request->input('query')}%")
				->orwhere("des","LIKE","%{$request->input('query')}%")
				->orwhere("title","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);
    }
	
	public function prodbanner(Request $reques)
	{
		
		$prodbanners = Prod::with(['cat'])->with(['sub'])->where('homer', '=', 'yes')->limit(10)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		return response()->json($prodbanners);
	}
	
	//public function index(Request $request , $catid ='' , $cat = '', $subid ='' , $sub = '')
	public function index(Request $request , $id ='' , $title = '', $cat ='' , $sub = '')
	{
        
		if(isset($id) && $id != '')
		{
			$row = Prod::where('prods.id', '=', $id)->first();
		}
		else
			$row = '';
		return view('welcome', compact( 'row'));
	}
	
	
	
	public function indexsearch(Request $request )
	{
	
		$sess = session_id();
		$token =  $request->session()->token();	
		$searchx = $request->searchx;
	
		$homenews1 =Prod::with(['cat'])->with(['sub'])
		->where("name","LIKE","%$searchx%")
		->orwhere("des","LIKE","%$searchx%")
		->orwhere("title","LIKE","%$searchx%")
		->orderBy('prods.ordx', 'DESC')
		->orderBy('prods.id', 'DESC')->paginate(7);


		
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
        
		return view('articlesearch' , compact( 'homenews1', 'searchx',
		 'homebannerlay1' , 'homebannerlay2' ,  'cathomelay2singles', 
		'cathomelay2singles2', 'cathomelay2singles3' , 'innerbayer1'
		));
	}
	
	
	
	public function indextag(Request $request , $tag)
	{
		
		
		$sess = session_id();
		$token =  $request->session()->token();
		
		if(isset($request->tag))
		{
			$tag = $request->tag;
		}
		$homenews1 =Prod::with(['cat'])->with(['sub'])
		->where("tagg","LIKE","%$tag%")
		
		->orderBy('prods.ordx', 'DESC')
		->orderBy('prods.id', 'DESC')->paginate(7);


		
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
        
		return view('articletag' , compact( 'homenews1', 'tag',
		 'homebannerlay1' , 'homebannerlay2' ,  'cathomelay2singles', 
		'cathomelay2singles2', 'cathomelay2singles3' , 'innerbayer1'
		));
	}
	
	
	public function detail(Request $request ,$id , $title = '',$cat='', $sub='')
	{

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
		
		$row = Prod::with(['cat'])->with(['sub'])->with(['gals'])
		->where('prods.id', '=', $id)->first();

		$catid = $row['catid'];
		$subid = $row['subid'];
		
		if($catid != '' && $catid != 0)
		{	
			$homenews1bycat =Prod::with(['cat'])->with(['sub'])->where('prods.catid', '=', $catid)
			->orderBy('prods.id', 'DESC')->limit(4)->get();	
		}

		if($subid != '' && $subid != 0)
		{
			$homenews1bysub =Prod::with(['cat'])->with(['sub'])->where('prods.catid', '=', $catid)
			->where('prods.subid', '=', $subid)->orderBy('prods.id', 'DESC')
			->limit(4)->get();
		}
		else
		{
			$homenews1bysub = '';
		}

		return view('politicaldetail', compact('row','title','cat','sub',
		 'homebannerlay1' , 'homebannerlay2' ,  'cathomelay2singles', 
		'cathomelay2singles2', 'cathomelay2singles3' , 'innerbayer1' , 'homenews1bycat' , 'homenews1bysub'
		));
	}
	
	
	
	public function about(Request $request )
	{
		return view('about');
	}
	
	public function contact(Request $request )
	{
		
		return view('contact'  );
	}
	
	
	public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
	
	
	public function contactus(Request $request)
	{
		request()->validate([
            'emailx' => 'required|email',
            'fullnamex' => 'required',
			'imhuman' => 'required',
            'captcha' => 'required|captcha'
        ],
        ['captcha.captcha'=>'Invalid captcha code.']);

		$name =  $request->fullnamex;
		$des = $request->des;
		$des = substr($des , 0, 8000);
		$des = nl2br($des);
		$email = $request->emailx;
		
		$webmail = "webdeveloper@socialist-armenia.org";
		$mailcontent2 = "
		<table border = 0 cellspacing = 3 cellpadding=3 
		width = 800 style = 'font-family:arial;font-size:13px;'>
		<tr><th colspan = 2 align = 'left'><u> The Following Contact Took Place </u> </th></tr>
		<tr><td width = 150 style = 'font-family:arial;font-size:13px;'  align = 'left'>Email:</td>
		<td width = 650 style = 'font-family:arial;font-size:13px;'  align = 'left'> $email</td></tr>
		<tr><td style = 'font-family:arial;font-size:13px;'  align = 'left'>Full Name:</td>
		<td  style = 'font-family:arial;font-size:13px;'  align = 'left'>$name </td></tr>
		<tr><td style = 'font-family:arial;font-size:13px;'  align = 'left'>Message:</td>
		<td  style = 'font-family:arial;font-size:13px;'  align = 'left'>$des </td></tr>
		</table>";
		$headers2  = "From: $email \r\n"; 
		$headers2 .= "Content-type: text/html\r\n";

		try
		{
			$mail2 =  mail($webmail, " A New Contact Feedback " , $mailcontent2, $headers2);
			$mail3 =  mail("absolute_wizard@hotmail.com", " A New Contact Feedback " , $mailcontent2, $headers2);
			$message = "email sent";
		}
		catch (\Exception $e) 
		{
			$message =  $e->getMessage();	
		}
		return response()->json("$message");	
	}
	
	public function service(Request $request )
	{	
		return view('service');
	}
	
	public function webdeveloper(Request $request )
	{	
		return view('webdeveloper');
	}

	public function rssFeed(Request $request )
	{	
		$prods = Prod::with(['cat'])->orderBy('id', 'desc')->limit(550)->get();
        return response()->view('feed', compact('prods'))->header('Content-Type', 'application/xml');
	}
	
	public function cathome1(Request $request)
	{
		$cathomelay2single = Cat::where('layerr', '=', '1')		
		->orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->offset(0)->limit(1)->first();
		return response()->json($cathomelay2single);
	}
	
	public function cathome2(Request $request)
	{
		$cathomelay3single = Cat::where('layerr', '=', '1')		
		->orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->offset(1)->limit(1)->first();
		return response()->json($cathomelay3single);
	}
	
	public function prodhomelayer1(Request $request)
	{	
		$prodhomelayer1s = Prod::with(['cat'])->with(['sub'])->where('layerr', '=', '1')->limit(12)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		return response()->json($prodhomelayer1s);
	}
	
	public function prodhomelayer2(Request $request)
	{	
		$prodhomelayer1s = Prod::with(['cat'])->with(['sub'])->where('layerr', '=', '2')->limit(12)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		return response()->json($prodhomelayer1s);
	}
	
	public function prodrightlayer3(Request $request)
	{	
		$prodhomelayer3s = Prod::with(['cat'])->with(['sub'])->where('layerr', '=', '3')->limit(12)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		return response()->json($prodhomelayer3s);
	}
	
	public function prodrightlayer1trend(Request $request)
	{	
		$prodrightlayer1trend = Prod::with(['cat'])->with(['sub'])->where('homer2', '=', 'yes')->limit(12)
		->orderBy('prods.ordx', 'DESC')->orderBy('prods.id', 'DESC')->get();
		return response()->json($prodrightlayer1trend);
	}
	
	
	public function tagright(Request $request)
	{	
		$tagghomelay1 = Tagg::limit(30)->orderBy('name', 'ASC')->get();
		return response()->json($tagghomelay1);
	}
	
	public function search2(Request $request)
	{
		$queryx2 = $request->queryx2;
		$request1 = '%' . $queryx2 . '%';
		//$request1 = '%' . $request->Input('queryx2') . '%';
		$rightsearhnews = Prod::where('name', 'like', $request1 )
		->orderBy('id', 'DESC')->limit(16)->get();		
		//return response()->json($request1);
		return response()->json($rightsearhnews);
	}
	
	
	
	public function indexjson(Request $request , $catid ='' , $cat = '', $subid ='' , $sub = '')
	{
		$this->middleware('cors');	
		if($catid != '' && $catid != 0)
		{
			if($subid != '' && $subid != 0)
			{
				$homenews1 =Prod::with(['cat'])->with(['sub'])
				->where('prods.catid', '=', $catid)->where('prods.subid', '=', $subid)->orderBy('prods.id', 'DESC')->paginate(12);
			}
			else
			{
				$homenews1 =Prod::with(['cat'])->with(['sub'])
				->where('prods.catid', '=', $catid)->orderBy('prods.id', 'DESC')->paginate(12);
			}
		}
		else 
		$homenews1 =Prod::with(['cat'])->with(['sub'])
		->orderBy('prods.ordx', 'DESC')
		->orderBy('prods.id', 'DESC')->paginate(12);
		return response()->json($homenews1);
	}
	
	public function detailapi(Request $request ,$id , $title = '',$cat='', $sub='')
	{	
		$row = Prod::with(['cat'])->with(['sub'])->with(['gals'])
		->where('prods.id', '=', $id)->first();
		return response()->json($row);
	}
	
	public function search(Request $request)
	{
		$queryx2 = $request->keywords;
		$request1 = '%' . $queryx2 . '%';
		//$request1 = '%' . $request->Input('queryx2') . '%';
		$rightsearhnews = Prod::with(['cat'])->with(['sub'])->where('name', 'like', $request1 )
		->orderBy('id', 'DESC')->paginate(18);		
		//return response()->json($request1);
		return response()->json($rightsearhnews);
	}
	
	
	public function indextagjson(Request $request , $tag)
	{

		if(isset($request->tag))
		{
			$tag = $request->tag;
		}
		$tagnews =Prod::with(['cat'])->with(['sub'])
		->where("tagg","LIKE","%$tag%")
		
		->orderBy('prods.ordx', 'DESC')
		->orderBy('prods.id', 'DESC')->paginate(10);
		
		return response()->json($tagnews);

	}
	
	
	
	
	
}
