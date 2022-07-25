<?php

namespace App\Providers;

use App\Http\Controllers\api\Contracts\ContactModelInterface;
use App\Models\Contact;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContactModelInterface::class, Contact::class);    
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
