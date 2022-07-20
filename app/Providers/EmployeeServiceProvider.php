<?php

namespace App\Providers;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Models\Employee;
use Illuminate\Support\ServiceProvider;

class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeModelInterface::class, Employee::class);
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
