<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Gate;
class UserController extends Controller
{
	
	public function __construct(){
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	   $user = auth()->user();

       return view('admin.users.index')->with(
			[
				'users'=> User::all(),
			]
	   );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		/*
			$user = new User();
			$user->username = 'something';
			$user->password = Hash::make('userpassword');
			$user->email = 'useremail@something.com';
			$user->save();
		
		*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		//IF NOT ADMIN
		if(Gate::denies('edit-users')) { 
			exit('ONLY ADMIN CAN EDIT USERS OK CLICK BACK SORRY');
		}
        
		return view('admin.users.edit')->with([
			'user'	=>	User::find($id),
			'roles'	=>	Role::all()
		]);
		
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$user = User::find($id);
		$user->roles()->sync($request->roles);
		return redirect()->route('user-control.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::find($id);
		$user->roles()->detach(); //delete all roles from pivot table
		$user->delete();			//deletes user
        return redirect()->route('user-control.index');
    }
	
	public function special()
    {
	   exit('YOU HAVE MANAGED TO GET HERE');
    }
}
