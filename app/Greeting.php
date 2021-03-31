<?php
// necceceruy so that laravel can load the all models
namespace App;

// so that we do not have to always write full postigion of Model like Class Greeting extends Illuminate\Database\Eloguent\Model
Use Illuminate\Database\Eloquent\Model;



//Now we have one Eloquent Database model to help us insert things to database
Class Greeting extends Model{
	//
	protected $fillable = ['body'];
}