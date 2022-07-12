<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Client;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(2)
                    ->has(Employee::factory(10)->has(Address::factory(2))->has(Contact::factory(2)))
                    ->has(Client::factory(10)->has(Address::factory(2))->has(Contact::factory(2)))
                    ->has(Address::factory(1))
                    ->has(Contact::factory(2))
                    ->create();
            
            
            
        
                
            
    
    }
}
