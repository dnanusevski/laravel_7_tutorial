<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use App\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;
	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function roles(){
		return $this->belongsToMany(Role::class);
	}
	
	public function hasAnyRoles($roles){
		//dd($this->roles());
		if($this->roles()->whereIn('name', $roles)->first()){
			return true;
		}
		return false;
	}
	
	public function hasAnyRole($role){
		if($this->roles()->where('name', $role)->first()){
			return true;
		}
		return false;
	}
}
