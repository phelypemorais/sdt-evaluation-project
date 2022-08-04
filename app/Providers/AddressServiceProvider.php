<?php

namespace App\Providers;

use App\Http\Controllers\api\Contracts\AddressModelInterface;
use App\Models\Address;
use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AddressModelInterface::class, Address::class);
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
