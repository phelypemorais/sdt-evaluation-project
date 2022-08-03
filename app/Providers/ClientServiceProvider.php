<?php

namespace App\Providers;

use App\Http\Controllers\api\Contracts\ClientModelInterface;
use App\Models\Client;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientModelInterface::class, Client::class);    

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
