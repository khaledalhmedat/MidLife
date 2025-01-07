<?php

namespace App\Providers;

use App\Repositories\Admin\Admin_Repository;
use App\Repositories\Admin\Admin_Repository_Interface;
use App\Repositories\Blood_donation\Blood_Donation_Repository;
use App\Repositories\Blood_donation\Blood_Donation_Repository_Interface;
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
        $this->app->bind(Admin_Repository_Interface::class, Admin_Repository::class);
        $this->app->bind(Blood_Donation_Repository_Interface::class, Blood_Donation_Repository::class);
    }

    
}
