<?php

namespace Tests\Feature\api;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;
use Tests\TestCase;
use Illuminate\Support\Str;

class EmployeeApiTest extends TestCase
{
    use RefreshDatabase;
     protected  string $endpoint = '/api/v1/employee/index';
    
    public function test_get_all_empty()
    {
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(0);
    }

    public function test_get_all()
    {
       Company::factory(1)->has(Employee::factory(10))->create();

      

        $response = $this->getJson($this->endpoint);
        $response->assertStatus(HttpResponse::HTTP_OK);
        
        $response->assertJsonCount(10);
    }
}
