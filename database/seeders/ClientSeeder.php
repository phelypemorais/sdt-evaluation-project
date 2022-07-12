<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory(10)->has(Address::factory(2))->has(Contact::factory(2))->create();
    }
}
