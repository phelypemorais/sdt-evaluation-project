<?php

namespace Tests\Feature\api;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Response as HttpResponse;
use Tests\TestCase;



class CompanyApiTest extends TestCase
{
    use RefreshDatabase;
    protected  string $endpoint = '/api/v1/company/index';


    public function test_get_all_empty()
    {
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(0,'data');
    }

    public function test_get_all()
    {
        Company::factory(10)->create();



        $response = $this->getJson($this->endpoint);
        // dd($response['data']);
        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(10,'data');
    }

    public function test_create()
    {

        //$this->withoutExceptionHandling();
        $data = ['name'=> 'Top Way Systems'];


        $response = $this->postJson(route('api.company.create'),$data);
        //   dd($response['success']);
        $response->assertExactJson(
            [
                'success' =>
                    'Empresa criada com sucesso!',
            ]
        );
    }


    public function test_create_name_validation_error()
    {
        // $this->withoutExceptionHandling();
        $payload = [
            'name' => '',

        ];

        $response = $this->postJson('/api/v1/company/create',$payload);
        //dd($response['errors']);
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson(
            [
                'errors' => [
                    "name" => [
                        0 => 'O campo nome deve ser obrigatório!',
                    ]
                ],
                'message'=> 'O campo nome deve ser obrigatório!',
            ]
        );
    }


    public function test_find_employee()
    {
        $company =  Company::factory()->create();

        $response = $this->getJson("/api/v1/company/find/{$company->id}");

        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure([

                'id',
                'name',

            ]
        );
    }

    public function test_find_not_found()
    {

        $response = $this->getJson("/api/v1/company/find/fake_value");
        //dd($response['message']);
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);

    }


    public function test_update()
    {
        // $this->withoutExceptionHandling();

        $company =  Company::factory()->create();



        $payload = [
            'name' => 'Name Update',
        ];

        $response = $this->putJson("/api/v1/company/update/{$company->id}",$payload);

        $response->assertStatus(HttpResponse::HTTP_OK);

    }



    public function test_delete()
    {

        $company =  Company::factory()->create();

        $response = $this->deleteJson("/api/v1/company/destroy/{$company->id}");

        $response->assertExactJson(
            [
                'success' => 'Empresa excluída com sucesso!',
            ]
        );

    }

    public function test_delete_not_found()
    {

        $response = $this->deleteJson("/api/v1/employee/company/fake_value");
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);
    }

}
