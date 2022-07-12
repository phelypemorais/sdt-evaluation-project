<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\company;
use App\Models\Contact;
use App\Models\Employee;
use Carbon\Factory;
use Database\Factories\ContactFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(10)->has(Contact::factory(1))->has(Address::factory(1))->create();
         
    }
}
