<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Client;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Employee;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $companies =  Company::factory(2)
                    ->has(Employee::factory(10)->has(Address::factory(2))->has(Contact::factory(2)))
                    ->has(Client::factory(10)->has(Address::factory(2))->has(Contact::factory(2)))
                    ->has(Address::factory(1))
                    ->has(Contact::factory(2))
                    ->create();
    //    foreach ($companies as $company) {
    //     $company->create(Employee::factory(2));
    //    }
     
      //dd($companies->where('id',1)->first()->employees->first()->contacts);
      //dd($company->first()->employees);
      //dd($company->find(1)->employees);
      
    }
}
