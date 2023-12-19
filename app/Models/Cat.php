<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prod;
use App\Models\Subcat;

class Cat extends Model
{
    use HasFactory;
	protected $fillable =['name','ordx','des','img','homer','layerr'];
	
	public function prods()
    {
    	return $this->hasMany('App\Models\Prod', 'catid' , 'id' , 'on_delete=models.CASCADE');
	}
	
	public function subs()
    {
    	return $this->hasMany('App\Models\Subcat', 'catid' , 'id' , 'on_delete=models.CASCADE');
	}
	
	
}
