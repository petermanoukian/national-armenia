<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\Tagg;
use DataTables;
use Image;

class TaggController extends Controller
{
   
   public function indexadmin(Request $request)
	{
		$this->middleware(['auth']);	
		$sess = session_id();
		$token =  $request->session()->token();	
		if ($request->ajax()) {
            //$data = Cat::withCount('subcats')->orderBy('name', 'ASC')->get();
			$data = Tagg::orderBy('name', 'ASC')->get();
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
							<form method = 'post' action = \"/appadmin/tag/delete/$id/\">
							".csrf_field(). method_field('DELETE') ."
							<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
							<input type=\"hidden\" name=\"_token\" value=\"$token\">
							<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
							class=\"btn btn-danger\">
							</form>
						</div>
						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/edittag/$id\" class=\"edit btn btn-primary btn-sm\">Edit </a>

						</div>
						";
                        return $btn;
                    })	

					->rawColumns(array("action",   'Delete1' ,))
                    ->make(true);
        }
		$cats= Tagg::orderBy('name', 'ASC')->paginate(2);
		return view('appadmin.viewtag', compact('cats'));
	}
	


	public function create()
    {
        $this->middleware(['auth']);
		return view('appadmin/addtag');
    }	
		
	public function edit($id)
	{
		$this->middleware(['auth']);
		$row = Tagg::findOrFail($id);
		return view('appadmin.edittag', compact('row'));
	}

	public function store(Request $request)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required'
		]);
		try
		{	

			$row = Tagg::create(['name' => $request->name ]);
			$row->save();
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
		}
		return Redirect::route('AdminTags.route');
	}
	
	
	public function update(Request $request, $id)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required'
		]);
		$row =  Tagg::findOrFail($id);
		try
		{	
			$row->update(['name' => $request->name]);
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
		}
		return Redirect::route('AdminTags.route');
	}	
	

	public function destroy($id )
	{
		$this->middleware(['auth']);
		$row = Tagg::find($id);
		$row->delete();
		return Redirect::route('AdminTags.route');
	}
	

	public function destroyall(Request $request)
	{
		$this->middleware(['auth']);
		
		if($request->idx && is_array($request->idx))
		{
			foreach($request->idx as $id)
			{
				$tag = Tagg::find($id);
				$tag->delete();	
			}
	
		}
		
		//Cat::destroy($id);
		return Redirect::route('AdminTags.route');
	}
   
   
   
   
}
