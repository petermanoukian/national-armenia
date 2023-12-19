<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;

use App\Models\Video;
use DataTables;
use Image;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;

class VideoController extends Controller
{
    
	
	public function indexadmin(Request $request )
	{
		$this->middleware(['auth']);
		
		$sess = session_id();
		$token =  $request->session()->token();
		if ($request->ajax()) {
			
		 
			$data = Video::orderBy('id', 'DESC')->get();

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
							<form method = 'post' action = \"/appadmin/vid/delete/$id/\">
							".csrf_field(). method_field('DELETE') ."
							<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
							<input type=\"hidden\" name=\"_token\" value=\"$token\">
							<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
							class=\"btn btn-danger\">
							</form>
						</div>

						<div style = 'display:inline;float:left;margin-left:5px;'>
							<a href=\"/appadmin/editvid/$id\" class=\"edit btn btn-primary btn-sm\">Edit </a>	
						</div>";
				return $btn;
			})

			->addColumn('linker', function($row)
			{
				$linkk = $row['linkk'];
				$link1 = "<a href = \"$linkk\" target = '_blank'> $linkk</a>";
				return $link1;
			})
			->rawColumns(array("action", 'Delete1' ,'linker'))
			->make(true);
        }
		return view('appadmin.viewvid' );
	}
	
	public function edit($id)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		$row = Video::where('id', '=', $id)->first();
		//return view('appadmin.editnew', compact('row','cats' , 'vids' , 'tag'));
		return view('appadmin.editvid', compact('row'));
	}

	public function create()
    {
        $this->middleware(['auth']);
		$userid = Auth::id();
		return view('appadmin.addvid');	
    }

	public function store(Request $request)
	{
		$this->middleware(['auth']);
		$this->validate($request, [
		'name' => 'required'  ]);
		$userid = Auth::id();

		try
		{	
			$name =  $request->name;
			$linkk =  $request->linkk;
			$layerr =  $request->layerr;
			$dess = $request->dess;
			$in =Video::create(['name' => "$name" ,'linkk' => "$linkk" ,'dess' => "$dess" ,'layerr' => "$layerr"
			]);
			$in->save();
			$LastInsertId = $in->id;
			return Redirect::route('ViewAdminVid.route' ); 				
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
		try
		{
			$dess = $request->dess;
			$linkk = $request->linkk;
			$name =  $request->name;
			$layerr =  $request->layerr;
			$row =Video::where('id', '=', $id)->first();
			$row->update(['name' => "$name" ,'linkk' => "$linkk" , 'layerr' => "$layerr" ,  'dess' => "$dess" ]);	
			$LastInsertId = $id;
			return Redirect::route('ViewAdminVid.route' ); 
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
		$gal =Video::where('id', '=', $id)->first();
		$gal->delete();
		return Redirect::route('ViewAdminVid.route' ); 
	}
	
	public function destroyall(Request $request)
	{
		$this->middleware(['auth']);
		$userid = Auth::id();
		if($request->idx && is_array($request->idx))
		{
			foreach($request->idx as $id)
			{
				$gal =Video::where('id', '=', $id)->first();
				$gal->delete();	
			}
		}
		return Redirect::route('ViewAdminVid.route' ); 
	}

	public function index(Request $request)
	{
		$sess = session_id();
		$token =  $request->session()->token();
		$linkks = Video::orderBy('id', 'DESC')->paginate(7);
		return view('video' , compact( 'linkks'));
	}
	
	
	public function homevideos1(Request $request)
	{

		$videos = Video::orderBy('id', 'DESC')->limit(4)->get();
		return response()->json($videos);
	}
	
	public function videorightbylayer(Request $request, $layer)
	{
		$video = Video::where('layerr', '=', $layer)->orderBy('id', 'DESC')->first();
		return response()->json($video);
	}
	
	
	public function indexjson(Request $request)
	{

		$videos = Video::orderBy('id', 'DESC')->paginate(10);
		return response()->json($videos);
	}
	
	
	
}
