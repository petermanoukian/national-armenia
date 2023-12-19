<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\Cat;
use App\Models\Prod;
use App\Models\Gal;
//use App\Models\Tagnew;
//use App\Models\Tag;
//use App\Models\Videor;
use DataTables;
use Image;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;

class GalController extends Controller
{
    
	public function indexadmin(Request $request , $prodid ='')
	{
		$this->middleware(['auth']);
		
		$sess = session_id();
		$token =  $request->session()->token();
		if ($request->ajax()) {
			
			if($prodid != '' && $prodid != 0)
			{
				$data =Gal::with(['prod'])->where('gals.prodid', '=', $prodid)->orderBy('gals.id', 'DESC')->get();
			}
			else 
			$data = Gal::with(['prod'])->orderBy('gals.id', 'DESC')->get();

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
							<form method = 'post' action = \"/appadmin/gal/delete/$id/\">
							".csrf_field(). method_field('DELETE') ."
							<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
							<input type=\"hidden\" name=\"_token\" value=\"$token\">
							<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
							class=\"btn btn-danger\">
							</form>
						</div>

						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/editgal/$id\" class=\"edit btn btn-primary btn-sm\">Edit </a>	
						</div>";
				return $btn;
			})
			->addColumn('Prod', function($row)
			{
				$prod = $row['prod']['name'];
				return $prod;
			})

			->addColumn('IMG', function($row)
			{
				$prodimg = $row['img'];
				$path = env('APP_URL');
				$prodimg1 = $path."images/gal/thumb/$prodimg";
				$img = "<img src=\"$prodimg1\" style='max-width:100px;'/>";
				return $img;
			})
			->rawColumns(array("action", "Prod",  'Delete1' , 'IMG'))
			->make(true);
        }
		return view('appadmin.viewgal' , compact( 'prodid'));
	}
	
	public function edit($id)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		$prods = Prod::orderBy('name', 'ASC')->get();

		$row = Gal::where('gals.id', '=', $id)->first();
		//return view('appadmin.editnew', compact('row','cats' , 'vids' , 'tag'));
		return view('appadmin.editgal', compact('row','prods'));
	}
	

	public function create($prodid ='' )
    {
        $this->middleware(['auth']);
		$userid = Auth::id();
		$prods = Prod::orderBy('name', 'ASC')->get();
		//$vids = Videor::orderBy('id', 'DESC')->limit(10)->get();
		//return view('appadmin.addnew', compact('cats' , 'vids' , 'catid'));
		return view('appadmin.addgal', compact('prods' ,  'prodid'));	
    }
	
	
	
	
	public function store(Request $request)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required' ,   'prodid' => 'required' ]);
		$userid = Auth::id();	
		$name =  $request->name;
		$title = $name;
		$title = str_replace(' ','-', $title);
		$prodid = $request->prodid;

		if($request->file('img'))
        {
			$file = $request->file('img');
			//$imageName = time().'.'.$request->img->extension(); 
			$random = substr(number_format(time() * rand(),0,'',''),0,3);
			$imageName = $title.'-'.$random.'.'.$request->img->extension();	
			$destinationPath = public_path().'/images/gal/thumb';
	
			$img = Image::make($file->path());
			$img->resize(180, 180, function ($constraint) {
			$constraint->aspectRatio();
			})->save($destinationPath.'/'.$imageName);

			$destinationPath2 = public_path().'/images/gal/medium';
			$img2 = Image::make($file->path());
			$img2->resize(400, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath2.'/'.$imageName);

			$imgx = Image::make($file->path());

			$destinationPath1 = public_path().'/images/gal';
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
				$request->img->move(public_path().'/images/gal/', $imageName);
			}
        }
		else
		$imageName = $request->pic;

		try
		{
			$in =Gal::create(['name' => "$name" ,'prodid' => "$prodid" ,
			'img' => "$imageName" 
			]);
			$in->save();
			$LastInsertId = $in->id;
			return Redirect::route('ViewAdminGal.route' ); 				
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
		$prodid = $request->prodid;
		$name =  $request->name;	
		$title = $name;
		$title = str_replace(' ','-', $title);

		if($request->file('img'))
        {
			$file = $request->file('img');
			//$imageName = time().'.'.$request->img->extension(); 
			$random = substr(number_format(time() * rand(),0,'',''),0,3);
			$imageName = $title.'-'.$random.'.'.$request->img->extension();				
			$destinationPath = public_path().'/images/gal/thumb';

			$img = Image::make($file->path());
			$img->resize(180, 180, function ($constraint) {
			$constraint->aspectRatio();
			})->save($destinationPath.'/'.$imageName);

			$destinationPath2 = public_path().'/images/gal/medium';
			$img2 = Image::make($file->path());
			$img2->resize(400, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath2.'/'.$imageName);

			$imgx = Image::make($file->path());

			$destinationPath1 = public_path().'/images/gal';
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
				$request->img->move(public_path().'/images/gal/', $imageName);
			}
        }
		else
		$imageName = $request->pic;


		try
		{
			$row =Gal::where('gals.id', '=', $id)->first();
			$row->update(['name' => "$name" ,'prodid' => "$prodid" ,
				'img' => "$imageName" 
			]);
			$LastInsertId = $id;
			return Redirect::route('ViewAdminGal.route' ); 
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
		$gal =Gal::where('gals.id', '=', $id)->first();
		$gal->delete();
		return Redirect::route('ViewAdminGal.route' ); 
	}
	
	public function destroyall(Request $request)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		if($request->idx && is_array($request->idx))
		{
			foreach($request->idx as $id)
			{
				$gal =Gal::where('gals.id', '=', $id)->first();
				$gal->delete();	
			}
		}
		return Redirect::route('ViewAdminGal.route' ); 
	}

}
