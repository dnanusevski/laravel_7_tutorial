<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
//use App\Greeting;

class Writer extends Model
{
    /*
	 protected static function boot(){
	 	parent::boot();
	 	static::addGlobalScope('name', function (Builder $builder){
	 		$builder->where('name', 'csaw');
	 	});
	}
	*/
	
	public function greeting(){
		return $this->hasOne(Greeting::class);
	}
}
