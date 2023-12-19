<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmailattach extends Mailable
{
    use Queueable, SerializesModels;
	


    public $contact;

    /**
     * Create a new message instance.
     *
     */
	public function __construct($contact=[])
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
			return $this
			->from('webdeveloper@national-armenia.org', 'Contact with attach from National Armenia')
			->markdown('mails.demo')
			 ->with([
                'name' => '',
				'name2' => '',
				'email' => '',
				'phone' => '',
				'message' => '',
                
            ])
			->subject('A new email from National Armenia Main')
			->attach($this->contact->path,
			[
				'as' => $this->contact->filename,
				'mime' => $this->contact->type,
			]);	
    }
}
