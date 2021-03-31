<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\notBielzabab;
use Illuminate\Support\MessageBag;

class FormExample extends Controller
{
    //
	public function index(){
		return view('form_example');
	}
	
	public function post(Request $request){
		
		/*
		echo '<pre>';
			print_r($request->all());
		echo '</pre>';
		echo '<pre>';
			print_r($request->except('_token'));
		echo '</pre>';
		*/
		//echo file_get_contents($request->file('image')->getRealPath());
		//$validated = $request->validate([
		//	'first_name' =>'required|max:128',
		//	'last_name' =>'required|max:128',
		//]);
		
		/*
		$rules = [
		    'first_name' => new notBielzabab(),
		    'last_name' => 'required',
		];

		//$customMessages = [
		//    'required' => 'The :attribute SHALL NOT STAY BLANK. Fly you fools'
		//];
		
		$customMessages = [
			'first_name.required' => 'You have not provided your first name, are you from another planet ?',
		];
		

		$this->validate($request, $rules, $customMessages);
		*/
		
		/*
		$errors = new MessageBag();
	
		$errors->add('MyOwn', 'MY PRECIOUS');
	
		return redirect()->back()->withErrors($errors);
		*/
		$messages = [
			'errors' => ['First error','Second error'],
			'mesages' => ['First message','Second message']
		];
		
		$errors = new MessageBag($messages);
		
		return redirect()->back()->withErrors($errors);
		
		//echo 'we will work in here';
	}
}
