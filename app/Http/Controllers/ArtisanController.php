<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Greeting;

class ArtisanController extends Controller
{
	

	protected $fillable = ['body'];
    // for this purpose we have created artisan.blade.php
	public function index(){
		
		//return "Artisan created controller method index said hello";
		return view('artisan')->with('myVar','myVar Value');
	}
	
	//This is a copu of index but no metter we will demonstrate a form
	public function create(){
		//return "Artisan created controller method index said hello";
		return view('artisan')->with('myVar','myVar Value');
	}
	
	//This is a copu of index but no metter we will demonstrate a form
	public function store(){
		//return "Artisan created controller method index said hello";
		Greeting::create(request()->only(['body']));
		return redirect('/form-create');
	}
	
	public function childTemplate(){
		return view('childTemplateArtisan');
	}
}
