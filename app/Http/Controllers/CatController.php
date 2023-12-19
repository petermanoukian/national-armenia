<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Models\Cat;
use App\Models\Subcat;
use App\Models\Prod;

use DataTables;
use Image;



class CatController extends Controller
{
	
	public function catnav()
	{
		$cats = Cat::with((['subs']))->where('homer', '=', 'yes')->limit(10)->
		orderBy('cats.ordx', 'DESC')->orderBy('cats.id', 'DESC')->get();	
		return response()->json($cats);	
	}
	
	
	public function indexadmin(Request $request)
	{
		$this->middleware(['auth']);	
		$sess = session_id();
		$token =  $request->session()->token();	
		if ($request->ajax()) {
            //$data = Cat::withCount('subcats')->orderBy('name', 'ASC')->get();
			$data = Cat::orderBy('name', 'ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()	
					->addColumn('Delete1', function($row) use ($token){
     					$id = $row['id'];
						$name = $row['name'];
                        $btn1 = "<input type = 'checkbox' name = 'idx[]' value = \"$id\">";
                        return $btn1;
                    })

                    ->addColumn('action', function($row) use ($token){
     					$id = $row['id'];
						$name = $row['name'];
						//$count = $row['prods_count'];
                        $btn = "
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<form method = 'post' action = \"/appadmin/cat/delete/$id/\">
							".csrf_field(). method_field('DELETE') ."
							<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
							<input type=\"hidden\" name=\"_token\" value=\"$token\">
							<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
							class=\"btn btn-danger\">
							</form>
						</div>
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/editcat/$id\" class=\"edit btn btn-primary btn-sm\">Edit </a>
							<a href=\"/appadmin/addsub/$id\" class=\"edit btn btn-primary btn-sm\">Add Sub Category </a>
							<a href=\"/appadmin/viewsub/$id\" class=\"edit btn btn-primary btn-sm\">Sub Categories <a>
						
							<a href=\"/appadmin/addprod/$id\" class=\"edit btn btn-primary btn-sm\">Add News </a>
							<a href=\"/appadmin/viewprod/$id\" class=\"edit btn btn-primary btn-sm\">News </a>
						</div>
						";
                        return $btn;
                    })	

					->rawColumns(array("action",   'Delete1' ,))
                    ->make(true);
        }
		$cats= Cat::orderBy('name', 'ASC')->paginate(2);
		return view('appadmin.viewcat', compact('cats'));
	}
	


	public function create()
    {
        $this->middleware(['auth']);
		return view('appadmin/addcat');
    }	
		
	public function edit($id)
	{
		$this->middleware(['auth']);
		$cat = Cat::findOrFail($id);
		return view('appadmin.editcat', compact('cat'));
	}

	public function store(Request $request)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required'
		]);
		
		$name =  $request->name;
		$title = $name;
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
			$des = $request->des;

			$cat = Cat::create(['name' => $request->name , 'ordx' => $request->ordx ,
			'des' => "$des" ,
			'homer' => $request->homer , 'layerr' => $request->layerr , 'img' => "$imageName"
			
			
			]);
			$cat->save();
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
		}
		return Redirect::route('AdminCats.route');
	}
	
	
	public function update(Request $request, $id)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required'
		]);
		$cat =  Cat::findOrFail($id);
		
		$name =  $request->name;
		$title = $name;
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
			$des = $request->des;

			$cat->update(['name' => $request->name , 'ordx' => $request->ordx , 'des' => "$des"
			,'homer' => $request->homer , 'layerr' => $request->layerr , 'img' => "$imageName"	
			]);
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
		}
		return Redirect::route('AdminCats.route');
	}	
	

	public function destroy($id )
	{
		$this->middleware(['auth']);
		$cat = Cat::with('prods')->with('subs')->find($id);	
		$prods = Prod::
		where('prods.catid', '=', $id)->get();
		//$prods->prodbranches()->delete();
		//$prods->prodtaggs()->delete();
		//$prods->prodvars()->delete();	
		if($prods)
		{	
			foreach($prods as $prod1)
			{
				$prodid = $prod1['id'];
				$prod = Prod::with('gals')->
				//with('prodtaggs')->
				//with('prodvars')->
				//with('discprods')->
				find($prodid);	
				
				$prod->gals()->delete();
				//$prod->prodtaggs()->delete();
				//$prod->prodvars()->delete();
				//$prod->discprods()->delete();
			}
			
		}

		$cat->subs()->delete();
		$cat->prods()->delete();
		$cat->delete();
		return Redirect::route('AdminCats.route');
	}
	

	public function destroyall(Request $request)
	{
		$this->middleware(['auth']);
		
		if($request->idx && is_array($request->idx))
		{
			foreach($request->idx as $id)
			{
				$cat = Cat::with('prods')->with('subs')->find($id);
				
				$prods = Prod::
				where('prods.catid', '=', $id)->get();
				//$prods->prodbranches()->delete();
				//$prods->prodtaggs()->delete();
				//$prods->prodvars()->delete();	
				if($prods)
				{	
					foreach($prods as $prod1)
					{
						$prodid = $prod1['id'];
						$prod = Prod::with('gals')->
						//with('prodtaggs')->
						//with('prodvars')->
						//with('discprods')->
						find($prodid);	
						
						$prod->gals()->delete();
						//$prod->prodtaggs()->delete();
						//$prod->prodvars()->delete();
						//$prod->discprods()->delete();
					}	
				}

				$cat->prods()->delete();
				$cat->subs()->delete();
				$cat->delete();	
			}
	
		}
		
		//Cat::destroy($id);
		return Redirect::route('AdminCats.route');
	}
	
	
	
}
