<?php

namespace Tests\Feature\api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Response as HttpResponse;
use Tests\TestCase;



class ClientApiTest extends TestCase
{
    use RefreshDatabase;
    protected  string $endpoint = '/api/v1/client/index';

    
    public function test_get_all_empty()
    {
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(0,'data');
    }

    public function test_get_all()
    {
         Client::factory(10)->create();



        $response = $this->getJson($this->endpoint);
       // dd($response['data']);
        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(10,'data');
    }

    public function test_create()
    {

    //$this->withoutExceptionHandling();
    $data = ['name'=> 'lypao morais'];
    

         $response = $this->postJson(route('api.client.create'),$data);
        //   dd($response['success']);
         $response->assertExactJson(
             [
                 'success' =>
                     'Cliente criado com sucesso!',
             ]
         );
    }


public function test_create_name_validation_error()
{
   // $this->withoutExceptionHandling();
    $payload = [
        'name' => '',
        
    ];

    $response = $this->postJson('/api/v1/client/create',$payload);
    //dd($response['errors']);
    $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

    $response->assertExactJson(
    [
        'errors' => [
            "name" => [
                0 => 'O campo nome deve ser Obrigatório!',
            ]
            ],
        'message'=> 'O campo nome deve ser Obrigatório!',
    ]
);
}


public function test_find_employee()
{
    $client =  Client::factory()->create();

   $response = $this->getJson("/api/v1/client/find/{$client->id}");

   $response->assertStatus(HttpResponse::HTTP_OK);
   $response->assertJsonStructure([

            'id',
            'name',

    ]
   );
}

    public function test_find_not_found()
    {

        $response = $this->getJson("/api/v1/client/find/fake_value");
       //dd($response['message']);
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);
        
    }


    public function test_update()
    {
       // $this->withoutExceptionHandling();

       $client =  Client::factory()->create();
        
        //dd($employee->id);

        $payload = [
            'name' => 'Name Update',
        ];

        $response = $this->putJson("/api/v1/client/update/{$client->id}",$payload);

        $response->assertStatus(HttpResponse::HTTP_OK);

    }

   

    public function test_delete()
    {

        $client =  Client::factory()->create();

        $response = $this->deleteJson("/api/v1/client/destroy/{$client->id}");
        
        $response->assertExactJson(
            [
                'success' => 'Cliente excluído com sucesso!',
            ]
        );

        }

    public function test_delete_not_found()
    {

        $response = $this->deleteJson("/api/v1/employee/client/fake_value");
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);
    }

}
