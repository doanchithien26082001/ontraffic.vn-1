<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;

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

        Validator::extend('email_exists', function ($attribute, $value, $parameters, $validator) {
            return DB::table('users')->where('email', $value)->exists();
        });
        Validator::extend('max_lines', function ($attribute, $value, $parameters, $validator) {
            $lines = preg_split('/\r\n|\r|\n/', $value);
            return count($lines) <= $parameters[0];
        });
    }
}
