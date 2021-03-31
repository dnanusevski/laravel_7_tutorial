<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Order;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
		 'App\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
		
		
		Gate::define('user-id-low', function ($user){
			return $user->id == 2;
		});
		
		Gate::define('edit-users', function ($user){
			return $user->hasAnyRole('admin');
		});
		
		Gate::define('manage-users', function ($user){
			return $user->hasAnyRoles(['admin', 'office']);
		});
		
		Gate::define('edit-order', function ($user, $order){
			return $user->id == $order->user_id;
		});
			
		Passport::routes();
        //
    }
}
