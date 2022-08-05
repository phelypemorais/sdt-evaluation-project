<?php


namespace Tests\Feature\api;

use App\Models\Address;
use App\Models\Client;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Str;
use Tests\TestCase;


class AddressApiTest extends TestCase
{
    use RefreshDatabase;

    protected string $endpoint = '/api/v1/address/index';
    
    protected function setUp(): void
    {     
        parent::setUp();
        $client = Client::factory()->create();
        
        $address = Address::factory()->make();

    $this->data = array_merge($address->toArray(),['addressable_id' => $client->id,'addressable_type' => 'client']);
          
    }

    public function test_get_all_empty()
    {   
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(0, 'data');
    }

    public function test_get_all()
    {
        Client::factory(10)->has(Address::factory(10))->create();


        $response = $this->getJson($this->endpoint);
        // dd($response['data']);
        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(10, 'data');
    }

    public function test_create()
    {


        $response = $this->postJson(route('api.address.create'), $this->data);
        $response->assertExactJson(
            [
                'success' => 'Endereço criado com sucesso!'
            ]
        );
    }


    public function test_create_street_validation_error()
    {


    $payload = array_merge($this->data,["street"=>null]);

        $response = $this->postJson('/api/v1/address/create', $payload);
        //dd($response['errors']);
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson(
            [
                'errors' => [
                    "street" => [
                        0 => 'O campo Rua é obrigatório!',
                    ]
                ],
                'message' => 'O campo Rua é obrigatório!',
            ]
        );
    }

    public function test_create_district_validation_error()
    {

        $payload = array_merge($this->data,["district"=>null]);

        $response = $this->postJson('/api/v1/address/create', $payload);
       
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson(
            [
                'errors' => [
                    "district" => [
                        0 => 'O campo Bairro é obrigatório!',
                    ]
                ],
                'message' => 'O campo Bairro é obrigatório!',
            ]
        );
    }

    public function test_create_zip_code_validation_error()
    {


        $payload = array_merge($this->data,["zip_code"=>null]);
        

        $response = $this->postJson('/api/v1/address/create', $payload);
        //dd($response['errors']);
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson(
            [
                'errors' => [
                    "zip_code" => [
                        0 => 'O campo CEP é obrigatório!',
                    ]
                ],
                'message' => 'O campo CEP é obrigatório!',
            ]
        );
    }
    public function test_create_city_validation_error()
    {

        $payload = array_merge($this->data,["city"=>null]);

        $response = $this->postJson('/api/v1/address/create', $payload);
      
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson(
            [
                'errors' => [
                    "city" => [
                       0 => 'O campo Cidade é obrigatório!',
                    ]
                ],
                'message' => 'O campo Cidade é obrigatório!',
            ]
        );
    }

    public function test_create_state_validation_error()
    {

        $payload = array_merge($this->data,["state"=>null]);

        $response = $this->postJson('/api/v1/address/create', $payload);
        //dd($response['errors']);
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson(
            [
                'errors' => [
                    "state" => [
                       0 => 'O campo Estado é obrigatório!',
                    ]
                ],
                'message' => 'O campo Estado é obrigatório!',
            ]
        );
    }


/**
 * @depends test_create
 */

    public function test_find_address_by_id()
    {

       $address = new Address();
     $address= $address->createAddresses($this->data);
       

        $response = $this->getJson("/api/v1/address/find/{$address->id}");

        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure([
                'id',
                'street',
                'district',
                'zip_code',
                'number',
                'complement',
                'city',
                'state',
                'addressable_id',
                'addressable_type',


            ]
        );
    }

    public function test_find_not_found()
    {

        $response = $this->getJson("/api/v1/address/find/fake_value");
        //dd($response['message']);
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);

    }


    public function test_update()
    {
        // $this->withoutExceptionHandling();

        $client =  Client::factory()->create();

        $data = [
            'street' => '1-463-905-6168',
            'district' => 'client',
            'zip_code' => "889988998889",
            'number' => '10',
            'complement' => 'ali',
            'city' => 'cariacica',
            'state' => 'ES',
            'addressable_id' => $client->id,
            'addressable_type' => 'clients'
        ];
        $address = new Address();
        $address = $address->createAddresses($data);

        $payload = [
            'street' => 'Street Update',
            'district' => 'District Update',
            'zip_code' => "Zip_code Update",
            'number' => 'Number Update',
            'complement' => 'Complement Update',
            'city' => 'City Update',
            'state' => 'State Update',
            'addressable_id' => Str::uuid(),
            'addressable_type' => 'clients'
        ];

        $response = $this->putJson("/api/v1/address/update/{$address->id}", $payload);

        $response->assertStatus(HttpResponse::HTTP_OK);

    }


    public function test_delete()
    {

        $client =  Client::factory()->create();

        $data = [
            'street' => '1-463-905-6168',
            'district' => 'client',
            'zip_code' => "889988998889",
            'number' => '10',
            'complement' => 'ali',
            'city' => 'cariacica',
            'state' => 'ES',
            'addressable_id' => $client->id,
            'addressable_type' => 'clients'
        ];

        $address = new Address();
        $address = $address->createAddresses($data);

        $response = $this->deleteJson("/api/v1/address/destroy/{$address->id}");

        $response->assertExactJson(
            [
                'success' => 'Endereço excluído com sucesso!',
            ]
        );

    }

    public function test_delete_not_found()
    {

        $response = $this->deleteJson("/api/v1/address/Destroy/fake_value");
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);
    }

}
