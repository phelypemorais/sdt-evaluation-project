<?php

namespace Tests\Feature\api;

use App\Models\Company;
use App\Models\Employee;
use GuzzleHttp\Psr7\Response as Psr7Response;
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

        $response->assertJsonCount(0,'data');
    }

    public function test_get_all()
    {
         Company::factory(1)->has(Employee::factory(10))->create();



        $response = $this->getJson($this->endpoint);
       // dd($response['data']);
        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(10,'data');
    }

    public function test_create()
    {

    //$this->withoutExceptionHandling();
    $company =  Company::factory()->create();

    $data = [

    'name' => 'phelype morais',
    'charge' => 'developer',
    'company_id' => $company->id
    ];

         $response = $this->postJson(route('api.employee.create'),$data);
         // dd($response['success']);
         $response->assertExactJson(
             [
                 'success' =>
                     'Funcionário criado com sucesso!',
             ]
         );
    }


public function test_create_charge_validation_error()
{
   // $this->withoutExceptionHandling();
    $payload = [
        'name' => 'phelype Morais',
        'company_id' => Str::uuid()
    ];

    $response = $this->postJson('/api/v1/employee/create',$payload);
      //$response = $this->postJson(route('api.employee.create'), $payload, ['Accept' => 'application/json']);
    //dd($response['errors']);
    $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

    $response->assertExactJson(
    [
        'errors' => [
            "charge" => [
                0 => "O campo do cargo é obrigatório!",
            ]
            ],
        'message'=> "O campo do cargo é obrigatório!"
    ]
);
}


public function test_create_name_validation_error()
{
   // $this->withoutExceptionHandling();
    $payload = [
        'charge' => 'Developer',
        'company_id' => Str::uuid()
    ];

    $response = $this->postJson('/api/v1/employee/create',$payload);

    //dd($response['errors']);
    $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

    $response->assertExactJson(
    [
        'errors' => [
            "name" => [
                0 => "O campo nome é obrigatório!",
            ]
            ],
        'message'=> "O campo nome é obrigatório!"
    ]
);
}


public function test_create_company_id_validation_error()
{
   // $this->withoutExceptionHandling();
    $payload = [
        'charge' => 'Developer',
        'name' => 'Phelype Morais'
    ];

    $response = $this->postJson('/api/v1/employee/create',$payload);

    //dd($response['errors']);
    $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

    $response->assertExactJson(
    [
        'errors' => [
            "company_id" => [
                0 => "O campo empresa é obrigatório!",
            ]
            ],
        'message'=> "O campo empresa é obrigatório!"
    ]
);
}

public function test_find_employee()
{
    $company =  Company::factory()->create();

    $data = [

    'name' => 'phelype morais',
    'charge' => 'developer',
    'company_id' => $company->id
    ];

    $employee = new Employee();
    $employee = $employee->createEmployees($data);


   $response = $this->getJson("/api/v1/employee/find/{$employee->id}");

   $response->assertStatus(HttpResponse::HTTP_OK);
   $response->assertJsonStructure([

            'id',
            'name',
            'charge',
            'company_id'

    ]
   );
}

    public function test_find_not_found()
    {

        $response = $this->getJson("/api/v1/employee/find/fake_value");
       //dd($response['message']);
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);

    }


    public function test_update()
    {
       // $this->withoutExceptionHandling();

        $company =  Company::factory()->create();
        $data = [

            'name' => 'phelype morais',
            'charge' => 'developer',
            'company_id' => $company->id
        ];

        $employee = new Employee();
        $employee = $employee->createEmployees($data);

        //dd($employee->id);

        $payload = [
            'name' => 'Name Update',
            'charge' => 'Charge Update',
            'company_id' => $company->id,
        ];

        $response = $this->putJson("/api/v1/employee/update/{$employee->id}",$payload);

        $response->assertStatus(HttpResponse::HTTP_OK);

    }

    public function test_update_not_found_company()
    {
       // $this->withoutExceptionHandling();

        $company =  Company::factory()->create();
        $data = [

            'name' => 'phelype morais',
            'charge' => 'developer',
            'company_id' => $company->id
        ];

        $employee = new Employee();
        $employee = $employee->createEmployees($data);

        //dd($employee->id);

        $payload = [
            'name' => 'Name Update',
            'charge' => 'Charge Update',
            'company_id' => "company",
        ];

        $response = $this->putJson("/api/v1/employee/update/{$employee->id}",$payload);

        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);

    }

    public function test_delete()
    {

        $company =  Company::factory()->create();
        $data = [

            'name' => 'phelype morais',
            'charge' => 'developer',
            'company_id' => $company->id
        ];

        $employee = new Employee();
        $employee = $employee->createEmployees($data);

        $response = $this->deleteJson("/api/v1/employee/destroy/{$employee->id}");

        $response->assertExactJson(
            [
                'success' => 'Funcionário excluído com sucesso!',
            ]
        );



    }

    public function test_delete_not_found()
    {

        $response = $this->deleteJson("/api/v1/employee/destroy/fake_value");
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);
    }

}
