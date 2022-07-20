<?php

namespace App\Providers;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Models\Company;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CompanyModelInterface::class, Company::class);    
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
