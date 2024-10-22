<?php

namespace App\Providers;

use App\Repositories\Examination\Examination_Repository_Interface;
use App\Repositories\Examination\Examination_Repository;
use App\Repositories\Users\Users_Repository_Interface;
use App\Repositories\Users\Users_Repository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function register()
    {
        $this->app->bind(Users_Repository_Interface::class, Users_Repository::class);
        $this->app->bind(Examination_Repository_Interface::class, Examination_Repository::class);
    }

    
}
