<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


use App\Mail\ContactEmail;
use App\Mail\ContactEmailattach;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
  	private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $audio_ext = ['mp3', 'ogg', 'mpga'];
    private $video_ext = ['mp4', 'mpeg'];
    private $document_ext = ['doc', 'docx', 'pdf', 'odt' , 'txt'];
	
    public function _construct()
    {
        $this->middleware('cors');
    }

    public function store(Request $request)
	{
	   $data = $this->validate($request, [
            'name' => 'required',
			'name2' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
		$name = $request->name;
		$name2 = $request->name2;
		$email = $request->email;
		$message = $request->message;
		$phone = $request->phone;
		$message1 = "<p> Name: $name $name2 </p>
					 <p>Phone: $phone </p>
					 <p> Message: $message <p>
					 <p>Email: $email </p> ";
					 
	
	
		$objDemo = new \stdClass();
        $objDemo->name = $name;
        $objDemo->name2 = $name2;
		$objDemo->email = $email;
		$objDemo->phone = $phone;
		$objDemo->message = $message;

 
        Mail::to("webdeveloper@socialist-armenia.org")->send(new ContactEmail($objDemo));
		
		
		return response()->json("sent");


	}
	
	
	private function getType($ext)
    {
        if (in_array($ext, $this->image_ext)) {
            return 'image';
        }

        if (in_array($ext, $this->audio_ext)) {
            return 'audio';
        }

        if (in_array($ext, $this->video_ext)) {
            return 'video';
        }

        if (in_array($ext, $this->document_ext)) {
            return 'document';
        }
    }


    private function allExtensions()
    {
        return array_merge($this->image_ext, $this->audio_ext, $this->video_ext, $this->document_ext);
    }


    private function getUserDir()
    {
        return Auth::user()->name . '_' . Auth::id();
    }
	public function storeattach(Request $request)
	{
		$this->middleware('cors');
		$data = $this->validate($request, [
            'name' => 'required',
			'name2' => 'required',
            'email' => 'required|email',
            //'message' => 'required',
			//'type' => Rule::in(['','document', 'image' , 'video' , 'audio']),
			
        ]);
		
		
		//$input = Input::all();
		$random = substr(number_format(time() * rand(),0,'',''),0,7);
		$attachment =  $request->attachment;
		$attachment1 = $random.'-'.$attachment;
		$msg = " ";

		if(isset($attachment) && $attachment != "" )
		{
			$name = $request->name;
			
			$ext = $request->file('attachment')->getClientOriginalExtension();
			$type = $this->getType($ext);
			
			
			$filer = $attachment->getClientOriginalName() ;
			$filer = $random.'-'.$filer;
			$destinationPath = public_path("/images/uploads");
			//$destinationPath = "../../../images/uploads";
			//$attachment->move($destinationPath,$attachment->getClientOriginalName());
			$attachment->move($destinationPath,$filer);
			if($type == 'document' || $type == 'image')
			{
				try
				{
					$filer = $attachment->getClientOriginalName() ;
					$filer = $random.'-'.$filer;
					Storage::putFileAs($type, new File(public_path("/images/uploads/$filer")), $filer);
					//Storage::putFileAs($type, new File("/images/uploads/$filer"), $filer);
					$msg .= " file attached ";
				}
				catch (exception $e) {
					//code to handle the exception
					$msg .= " file uplaod issue $e ";
				} 
			}
			else{
				$msg .= " not allowed file type ";
				//return response()->json(" not allowed file type ");
				//exit;

			}
			$path = public_path("/images/uploads/") .   $filer;
			//$filename = $name  . '.' . $ext;
			$filename = $filer;
			$name2 = $request->name2;
			$email = $request->email;
			$message = $request->message;
			$phone = $request->phone;
			
			$contactx = [
				
			'attachment' => $attachment1,
			]; 
			
			
			$contact = new \stdClass();
			$contact->name = $name;
			$contact->name2 = $name2;
			$contact->email = $email;
			$contact->phone = $phone;
			$contact->message = $message;
			$contact->attachment = $attachment;
			$contact->ext = $ext;
			$contact->type = $type;
			$contact->path = $path;
			$contact->filename = $filename;
			try
			{
				Mail::to("webdeveloper@national-armenia.org")->send(new ContactEmailattach($contact));
				$msg .= " email sent with attached file ";
			}
			catch (exception $e) {
				//code to handle the exception
				$msg .= " email with attached file not  sent error $e";
			}

			return response()->json(" $msg ");
		}
		else
		{
			$name = $request->name;
			$name2 = $request->name2;
			$email = $request->email;
			$message = $request->message;
			$phone = $request->phone;
			$message1 = "<p> Name: $name $name2 </p>
			 <p>Phone: $phone </p>
			 <p> Message: $message <p>
			 <p>Email: $email </p> ";	
			$objDemo = new \stdClass();
			$objDemo->name = $name;
			$objDemo->name2 = $name2;
			$objDemo->email = $email;
			$objDemo->phone = $phone;
			$objDemo->message = $message;
			
			try
			{
				Mail::to("webdeveloper@national-armenia.org")->send(new ContactEmail($objDemo));
				$msg .= " email sent ";
			}
			catch (exception $e) {
				//code to handle the exception
				$msg .= " email not  sent error $e";
			}
			return response()->json(" $msg ");
			
			//
			//Mail::to("webdeveloper@national-armenia.org")->send(new ContactEmail($objDemo));
			//return response()->json(" Thank you, your email has been sent ");
		}
	}
	
	public function basic_email() 
	{
        $data = array('name'=>"Virat Gandhi");
	   
		Mail::send(['text'=>'mail'], $data, function($message) {
			 $message->to('info@bedigm.com', 'Tutorials Point')->subject
				('Laravel Basic Testing Mail');
			 $message->from('info@bedigm.com','Virat Gandhi');
		  });
		echo "Basic Email Sent. Check your inbox.";
   
    }
	
    public function html_email() 
	{
		  $data = array('name'=>"Virat Gandhi");
		  Mail::send('mail', $data, function($message) {
			 $message->to('abc@gmail.com', 'Tutorials Point')->subject
				('Laravel HTML Testing Mail');
			 $message->from('xyz@gmail.com','Virat Gandhi');
		  });
		  echo "HTML Email Sent. Check your inbox.";
    }
	
    public function attachment_email() 
    {
		  $data = array('name'=>"Virat Gandhi");
		  Mail::send('mail', $data, function($message) {
			 $message->to('abc@gmail.com', 'Tutorials Point')->subject
				('Laravel Testing Mail with Attachment');
			 $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
			 $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
			 $message->from('xyz@gmail.com','Virat Gandhi');
		  });
		  echo "Email Sent with attachment. Check your inbox.";
    }
	
	
	
	
}
