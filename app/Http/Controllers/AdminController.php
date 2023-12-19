<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use DataTables;



class AdminController extends Controller
{
    public function _construct()
    {
        $this->middleware(['auth']);
    }
	
	
	public function indexadmin(Request $request , $levell = '')
	{	
		$this->middleware(['auth']);
		$sess = session_id();
		$token =  $request->session()->token();
		if ($request->ajax()) 
		{
            
			
			$data =User::get();
			
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) use ($token){
     					$id = $row['id'];
						$articlecatid = $row['id'];
						$name = $row['name'];
						$email = $row['email'];
					

                        $btn = "<div style = 'display:inline;float:left;margin-left:5px;'>
									<form method = 'post' action = \"/appadmin/user/delete/$id\">
									<input name=\"_method\" type=\"hidden\" value=\"DELETE\">
									<input type=\"hidden\" name=\"_token\" value=\"$token\">
									<input type = 'submit' value = 'Delete' onclick = 'return confirm(\"are you sure you want to remove this item\");'/
									class=\"btn btn-danger\">
									</form>
								</div>
								<div style = 'display:inline;float:left;margin-left:5px;'>
									<a href=\"/appadmin/edituser/$id\" class=\"edit btn btn-primary btn-sm\">Edit</a>
								 </div>";
    
                            return $btn;
                    })
					
                    //->rawColumns(['action'])
					->rawColumns(array("action"))
                    ->make(true);
        }

		return view('appadmin.viewuser');
	}
	
	
	
	public function create()
    {  
		$this->middleware(['auth']);
		return view('appadmin/register');
    }
	
	

	
	
	
	public function edit($id)
	{
		$this->middleware(['auth']);
		$row =User::find($id);
		return view('appadmin.edituser', compact('row'));
	}
	


	
		public function store(Request $request)
    {
		try
		{
			$this->middleware(['auth']);
			$user = User::create(['name' => $request->name ,  'email' => $request->email ,
			 'password' => Hash::make($request->password)

			 ]);
			$user->save();
		}
		catch (\Exception $e) 
		{
    		$message =  $e->getMessage();
		}
		return Redirect::route('viewUser.route');

    }


	public function update(Request $request, $id)
	{
		 $this->middleware(['auth']);
		$this->validate($request, [
		    'name' => ['required', 'string', 'max:255'],	
            'email' => ['required', 'string', 'email', 'max:255'],
		]);
		$conf2 = $request->conf2;
		
		$user =User::findOrFail($id);
		
		if($request->password && $request->password != "")
		{
			//echo " HERE 137 ";
			try
			{
				 $name = $request->name;
				 $email = $request->email;
				 $user->update(['name' => $request->name ,  'email' => $request->email ,
				 'password' => Hash::make($request->password)]);
		
				 
			}
			catch (\Exception $e) 
			{
				$message =  $e->getMessage();
			}
		}
		else
		{
			//echo " HERE 153 ";
			try
			{
				$user->update(['name' => $request->name ,  'email' => $request->email ]);
				 
				$name = $request->name;
				$email = $request->email;
		 
			}
			catch (\Exception $e) 
			{
				$message =  $e->getMessage();
			}
		}
	

		return Redirect::route('viewUser.route');
	}

	
	
	public function destroy($id )
	{
		$this->middleware(['auth','is_admin']);
		$user =User::where('users.id', '=', $id)->first();
	
		
		
		/*
		$user->prods()->prodbranches()->delete();
		$user->prods()->prodtaggs()->delete();
		$user->prods()->prodvars()->delete();
		*/
		

		$user->delete();
		//User::destroy($id);
		return Redirect::route('AdminUser.route');
	}
	




}
