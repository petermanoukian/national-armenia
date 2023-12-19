<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prod;

class Gal extends Model
{
    use HasFactory;
	
	protected $fillable =['prodid','name','img'];
	
	public function prod()
    {
        return $this->belongsTo('App\Models\Prod', 'prodid' , 'id');
    }
	
	
}
