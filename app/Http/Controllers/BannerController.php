<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;

use App\Models\Banner;
use DataTables;
use Image;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;




class BannerController extends Controller
{
   public function indexadmin(Request $request )
	{
		$this->middleware(['auth']);
		
		$sess = session_id();
		$token =  $request->session()->token();
		if ($request->ajax()) {
			
			
			$data = Banner::orderBy('id', 'DESC')->get();

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
				$name = $row['name'];
				$btn = "<div style = 'display:inline;float:left;margin-left:5px;'>
							<form method = 'post' action = \"/appadmin/ban/delete/$id/\">
							".csrf_field(). method_field('DELETE') ."
							<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
							<input type=\"hidden\" name=\"_token\" value=\"$token\">
							<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
							class=\"btn btn-danger\">
							</form>
						</div>
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/editban/$id\" class=\"edit btn btn-primary btn-sm\">Edit </a>	
						</div>";
				return $btn;
			})
			->addColumn('linker', function($row)
			{
				$linkk = $row['linkk'];
				$link1 = "<a href = \"$linkk\" target = '_blank'> $linkk</a>";
				return $link1;
			})
			->addColumn('Type', function($row)
			{
				$typ = $row['typ'];
				$posx = $row['posx'];
				if($typ == 'linkk')
					$type1 = " Link ";
				else
					$type1 = " $typ ";
				
				$type1 = " $type1 $posx";
				return $typ;
			})
			->addColumn('IMG', function($row)
			{
				$prodimg = $row['img'];
				$path = env('APP_URL');
				$prodimg1 = $path."images/ban/thumb/$prodimg";
				$img = "<img src=\"$prodimg1\" style='max-width:100px;'/>";
				return $img;
			})
			->rawColumns(array("action",   'Delete1' , 'IMG' ,'linker','Type'))
			->make(true);
        }
		return view('appadmin.viewban');
	}
	
	public function edit($id)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		$row = Banner::where('id', '=', $id)->first();
		return view('appadmin.editban', compact('row'));
	}

	public function create()
    {
        $this->middleware(['auth']);
		$userid = Auth::id();
		return view('appadmin.addban');	
    }

	public function store(Request $request)
	{
		$this->middleware(['auth']);

		$userid = Auth::id();
		
		$posx =  $request->posx;
		$name =  $request->name;
		$typ =  $request->typ;
		$linkk =  $request->linkk;
		$des =  $request->des;
		$dess =  $request->dess;
		
		$title = $name;
		$title = str_replace(' ','-', $title);
		

		if($request->file('img'))
        {
			$file = $request->file('img');
			//$imageName = time().'.'.$request->img->extension(); 
			$random = substr(number_format(time() * rand(),0,'',''),0,3);
			$imageName = $title.'-'.$random.'.'.$request->img->extension(); 			
			$destinationPath = public_path().'/images/ban/thumb';
	
			$img = Image::make($file->path());
			$img->resize(180, 180, function ($constraint) {
			$constraint->aspectRatio();
			})->save($destinationPath.'/'.$imageName);
			
			
			$destinationPath2 = public_path().'/images/ban/medium';
			$img2 = Image::make($file->path());
			$img2->resize(400, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath2.'/'.$imageName);

			$imgx = Image::make($file->path());

			$destinationPath1 = public_path().'/images/ban';
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
				$request->img->move(public_path().'/images/ban/', $imageName);
			}
        }
		else
		$imageName = '';

		try
		{
			$in =Banner::create(['name' => "$name" ,'posx' => "$posx" ,'img' => "$imageName" ,
			'typ' => "$typ" ,'linkk' => "$linkk" ,'des' => "$des"  ,'dess' => "$dess"
			]);
			$in->save();
			$LastInsertId = $in->id;
			return Redirect::route('ViewAdminBan.route' ); 				
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
			echo "message 205 $message ";	
		}	
	}


	public function update(Request $request, $id)
	{
		$this->middleware(['auth']);
		
		$posx = $request->posx;
		$name =  $request->name;
		$typ =  $request->typ;
		$linkk =  $request->linkk;
		$des =  $request->des;
		$dess =  $request->dess;

		$title = $name;
		$title = str_replace(' ','-', $title);
		
		
		if($request->file('img'))
		{
			$file = $request->file('img');
			//$imageName = time().'.'.$request->img->extension(); 
			$random = substr(number_format(time() * rand(),0,'',''),0,3);
			$imageName = $title.'-'.$random.'.'.$request->img->extension(); 				
			$destinationPath = public_path().'/images/ban/thumb';
	
			$img = Image::make($file->path());
			$img->resize(180, 180, function ($constraint) {
			$constraint->aspectRatio();
			})->save($destinationPath.'/'.$imageName);
			
			
			$destinationPath2 = public_path().'/images/ban/medium';
			$img2 = Image::make($file->path());
			$img2->resize(400, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath2.'/'.$imageName);

			$imgx = Image::make($file->path());

			$destinationPath1 = public_path().'/images/ban';
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
				$request->img->move(public_path().'/images/ban/', $imageName);
			}
		}
		else
		$imageName = $request->pic;

		try
		{
			$row =Banner::where('id', '=', $id)->first();
			$row->update(['name' => "$name" ,'posx' => "$posx" ,'img' => "$imageName" ,
			'typ' => "$typ" ,'linkk' => "$linkk" ,'des' => "$des"  ,'dess' => "$dess"	
			]);	
			$LastInsertId = $id;
			return Redirect::route('ViewAdminBan.route' ); 
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
		$gal =Banner::where('id', '=', $id)->first();
		$gal->delete();
		return Redirect::route('ViewAdminBan.route' ); 
	}
	
	public function destroyall(Request $request)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		if($request->idx && is_array($request->idx))
		{
			foreach($request->idx as $id)
			{
				$gal =Banner::where('id', '=', $id)->first();
				$gal->delete();	
			}
		}
		return Redirect::route('ViewAdminBan.route' ); 
	}

	public function index(Request $request)
	{
		$sess = session_id();
		$token =  $request->session()->token();
		$linkks = Banner::where('typ', '=', "linkk")->orderBy('id', 'DESC')->paginate(7);
		return view('linkk' , compact( 'linkks'));
	}
	
	
	public function bannerlayer1json(Request $request)
	{
		$innerbayer1= Banner::where('posx', '=' , '1')->where('typ', '=' , 'banner')->first();
		return response()->json($innerbayer1);
	}
	
	public function bannerlayer2json(Request $request)
	{
		$innerbayer2= Banner::where('posx', '=' , '2')->where('typ', '=' , 'banner')->first();
		return response()->json($innerbayer2);
	}
	
	
	public function bannerlayer3json(Request $request)
	{
		$innerbayer3= Banner::where('posx', '=' , '3')->where('typ', '=' , 'banner')->first();
		return response()->json($innerbayer3);
	}
	
	public function bannerlayer4json(Request $request)
	{
		$innerbayer4= Banner::where('posx', '=' , '4')->where('typ', '=' , 'banner')->first();
		return response()->json($innerbayer4);
	}
	
	public function bannerlayer5json(Request $request)
	{
		$innerbayer5= Banner::where('posx', '=' , '5')->where('typ', '=' , 'banner')->first();
		return response()->json($innerbayer5);
	}
	
	
	public function indexjson(Request $request )
	{
		$this->middleware('cors');	

		$linkks = Banner::
		where('typ', '=', "linkk")->
		orderBy('id', 'DESC')->paginate(12);
		return response()->json($linkks);
	}
	
	
	

}
