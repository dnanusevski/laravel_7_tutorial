<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		// lets share one data with all the views
		view()->share('sharedData', 'sharedDataValue');
		
		$parameter = true;
		
		//do not do any logic inside blade directives always outside !!!!
		Blade::directive('hasdubdomain', function ($parameter){
			// instead of this we would have some function to determine does it realy have subdomain
			//$hasDubDomain = true; //do not do any logic inside blade directives always outside !!!!
			$hasDubDomain = $parameter;//do not do any logic inside blade directives always outside !!!!
			
			return "<?php if(true) {  ?>";
		});
		
		Blade::directive('endhasdubdomain', function (){
			return "<?php } ?>";
		});
		
		
		Blade::if('isDimeLord', function(){
			return true;
		});
		
    }
}
