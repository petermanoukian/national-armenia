<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Models\Cat;
use App\Models\Subcat;

use App\Models\Prod;
use DataTables;




class SubcatController extends Controller
{
    public function getSubcatAjax(Request $request)
    {
		
		if($request->subid != "")
		{
			$subid = $request->subid;
		}
		else
		{
			$subid = '';
		}
		if($request->catid != "")
		{
			$html = '<select class="form-control" name = "subid" id="subid">
			<option value = "">Choose Subcategory</option>';
			$subcats = Subcat::where('catid', $request->catid)->orderBy('name', 'ASC')->get();
			$count = count($subcats);
			if($subcats && !empty($subcats) && $count > 0)
			{
				foreach ($subcats as $subcat) 
				{
					if($subid != "" && $subid == $subcat->id)
					$html .= '<option value="'.$subcat->id.'" selected>'.$subcat->name.
					
					'</option>';
					else
					$html .= '<option value="'.$subcat->id.'">'.$subcat->name.
					
					'</option>';
				}
			
				$html .= "</select>";
			}
			else 
			$html = '<select class="form-control" name = "subid" id="subid"></select> ';
		}
		else
		$html = 'Choose A Sub Category';
    	return response()->json(['html' => $html]);
    }

	
	public function indexadmin(Request $request, $catid='')
	{
		$this->middleware(['auth']);
		
		$sess = session_id();
		$token =  $request->session()->token();
		
		if ($request->ajax()) {
		
			if($catid != "" && $catid != NULL)
			{
				$data =Subcat::where('subcats.catid', '=', $catid)->with(['subprods'])->with(['catsubb'])
				->orderby('subcats.name' , 'ASC')
				->get();	
			}
			else
			{
				$data =Subcat::with(['subprods'])->with(['catsubb'])
				->orderby('subcats.name' , 'ASC')
				->get();
			}			
			
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
						$cat = $row['catsubb']['name'];
						$catid1 = $row['catsubb']['id'];
						$catid2 = $row['catid'];

                        $btn = "
						<div style = 'display:inline;float:left;margin-left:5px;'>
						<form method = 'post' action = \"/appadmin/prodsub/delete/$id/$catid1\">
						".csrf_field(). method_field('DELETE') ."
						<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
						<input type=\"hidden\" name=\"_token\" value=\"$token\">
						<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
						class=\"btn btn-danger\">
						</form>
						</div>
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/editsub/$id\" class=\"edit btn btn-primary btn-sm\">Edit  </a>
						</div>	
						
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/addprod/$catid2/$id\" class=\"edit btn btn-primary btn-sm\">
							Add News </a>
							<a href=\"/appadmin/viewprod/$catid2/$id\" class=\"edit btn btn-primary btn-sm\">
							News </a>
						</div>";
    
                            return $btn;
                    })
                    ->rawColumns(['action','Delete1'])
                    ->make(true);
        }
		//$cats=Country::orderBy('id', 'DESC')->paginate(2);
		$cats = Cat::orderBy('id', 'DESC')->get();
		return view('appadmin.viewprodsub' , compact('catid', 'cats'));
	}

	
	public function create($catid='')
    {
        $this->middleware(['auth']);
		$cats = Cat::orderBy('name', 'ASC')->get();
		return view('appadmin/addprodsub', compact('cats','catid'));
    }
	
	public function edit($id)
	{
		$this->middleware(['auth']);
		$row =Subcat::findOrFail($id);
		$cats = Cat::orderBy('name', 'ASC')->get();
		return view('appadmin.editprodsub', compact('row' , 'cats'));
	}
	
	public function store(Request $request)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required' , 'catid' => 'required' ,
		]);
		$catid =$request->catid;
		try
		{
			
			if($request->file('img'))
			{
				$file = $request->file('img');
				$imageName = time().'.'.$request->img->extension(); 	
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
			
			
			
			$cat =Subcat::create([ 'catid' => $request->catid ,'name' => $request->name 
			, 'ordx' => $request->ordx , 'des' => "$des" , 'img' => "$imageName"

			]);
			$cat->save();
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
		}
		//return view('admin.prodcat');
		return Redirect::route('AdminProdsub.route' , [$catid]);
	}
	
	public function update(Request $request, $id)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		 'catid' => 'required','name' => 'required' 
		]);
		$catid =$request->catid;
		$cat =Subcat::findOrFail($id);
		try
		{
			
			if($request->file('img'))
			{
				$file = $request->file('img');
				$imageName = time().'.'.$request->img->extension(); 	
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

			$cat->update(['name' => $request->name , 'catid' => $request->catid
			, 'ordx' => $request->ordx , 'des' => "$des" , 'img' => "$imageName"	
			]);
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
		}
		return Redirect::route('AdminProdsub.route' , [$catid]);
	}	

	
	public function destroyall(Request $request ,  $catid='')
	{
		$this->middleware(['auth','is_admin']);
		
		if($request->idx && is_array($request->idx))
		{
			foreach($request->idx as $id)
			{
				$sub = Subcat::with('subprods')->find($id);
				
				$prods = Prod::where('prods.subid', '=', $id)->get();
				if($prods)
				{
					foreach($prods as $prod1)
					{
						$prodid = $prod1['id'];
						$prod = Prod::with('gals')->find($prodid);	
						$prod->gals()->delete();
					}
				}
				
				
				$sub->subprods()->delete();
				$sub->delete();
			}
		}
		return Redirect::route('AdminProdsub.route', [$catid]);
	}
	
	
	public function destroy($id , $catid ='')
	{
		$this->middleware(['auth','is_admin']);
		
		$sub = Subcat::with('subprods')->find($id);
		
		$prods = Prod::where('prods.subid', '=', $id)->get();
		
		if($prods)
		{
			foreach($prods as $prod1)
			{
				$prodid = $prod1['id'];
				$prod = Prod::with('gals')->find($prodid);	
				$prod->gals()->delete();
			}
		}
		

		$sub->subprods()->delete();
		$sub->delete();
		//Subcat::destroy($id);
		return Redirect::route('AdminProdsub.route' , [$catid]);
	}
	
	
	
}
