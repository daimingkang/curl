<?php

namespace Cxycdz\Curl;

use Illuminate\Support\ServiceProvider;

class CurlProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('curl',function(){
        return new Curl();
        });//相当于其他地方就可以用app('curl')
    }
}
