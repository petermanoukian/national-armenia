<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cat;
use App\Models\Prod;

class Subcat extends Model
{
    use HasFactory;
	
	protected $fillable =['catid','name','ordx','des','img'];
	
	public function catsubb()
    {
        return $this->belongsTo('App\Models\Cat', 'catid' , 'id');
    }
	
	public function subprods()
    {
    	return $this->hasMany('App\Models\Prod', 'subid' , 'id' , 'on_delete=models.CASCADE');
	}
	
	
}
