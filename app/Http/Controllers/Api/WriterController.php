<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Writer;
use App\Http\Resources\Writer as WriterResource;

class WriterController extends Controller
{

	public function apiList(){
		//return ['hello'];
		//return new WriterResource(Writer::find(25));
		return WriterResource::collection(Writer::all());
	}
	
}
