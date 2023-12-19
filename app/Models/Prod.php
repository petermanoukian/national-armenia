<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cat;
use App\Models\Gal;
use App\Models\Subcat;


class Prod extends Model
{
    use HasFactory;
	protected $fillable =['catid','subid','name','ordx','des','dess','img','title','keywordd',
	'metades','lang','video','tagg','homer','homer2','layerr','dater'];
	
	public function cat()
    {
        return $this->belongsTo('App\Models\Cat', 'catid' , 'id');
    }
	
	public function sub()
    {
        return $this->belongsTo('App\Models\Subcat', 'subid' , 'id');
    }
	
	public function gals()
    {
    	return $this->hasMany('App\Models\Gal', 'prodid' , 'id' , 'on_delete=models.CASCADE');
	}
	
	
	
}
