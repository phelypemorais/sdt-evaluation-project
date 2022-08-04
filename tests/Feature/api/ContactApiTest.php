<?php


namespace Tests\Feature\api;

use App\Models\Client;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Response as HttpResponse;
use Tests\TestCase;


class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    protected string $endpoint = '/api/v1/contact/index';


    public function test_get_all_empty()
    {
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(0, 'data');
    }

    public function test_get_all()
    {
       client::factory(10)->has(contact::factory(10))->create();


        $response = $this->getJson($this->endpoint);
        // dd($response['data']);
        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJsonCount(10, 'data');
    }

    public function test_create()
    {

        //$this->withoutExceptionHandling();
           Client::factory()->create();

        $data = [
            'number' => '1-463-905-6168',
            'contactable_type' => 'client',
            'contactable_id' => "889988998889"
        ];



        $response = $this->postJson(route('api.contact.create'), $data);
        //   dd($response['success']);
        $response->assertExactJson(
            [
                'success' =>
                    'Contato criado com sucesso!',
            ]
        );
    }


    public function test_create_number_validation_error()
    {
        // $this->withoutExceptionHandling();
        $payload = [
            'number' => '',

        ];

        $response = $this->postJson('/api/v1/contact/create', $payload);
        //dd($response['errors']);
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson(
            [
                'errors' => [
                    "number" => [
                        0 => 'O campo contato deve ser obrigatório!',
                    ]
                ],
                'message' => 'O campo contato deve ser obrigatório!',
            ]
        );
    }


    public function test_find_Contact()
    {

       $client =  Client::factory()->create();

        $data = [
            'number' => '1-463-905-6168',
            'contactable_type' => 'client',
            'contactable_id' => $client->id
        ];
        $contact = new Contact();
        $contact = $contact->createContacts($data);

        $response = $this->getJson("/api/v1/contact/find/{$contact->id}");

        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure([
                'id',
                'number',
                'contactable_id',
                'contactable_type',


            ]
        );
    }

    public function test_find_not_found()
    {

        $response = $this->getJson("/api/v1/contact/find/fake_value");
        //dd($response['message']);
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);

    }


    public function test_update()
    {
        // $this->withoutExceptionHandling();

        $client =  Client::factory()->create();

        $data = [
            'number' => '1-463-905-6168',
            'contactable_type' => 'client',
            'contactable_id' => $client->id
        ];
        $contact = new Contact();
        $contact = $contact->createContacts($data);

        $payload = [
            'number' => '997550668',
        ];

        $response = $this->putJson("/api/v1/contact/update/{$contact->id}", $payload);

        $response->assertStatus(HttpResponse::HTTP_OK);

    }


    public function test_delete()
    {

        $company = Company::factory()->create();

        $response = $this->deleteJson("/api/v1/contact/destroy/{$company->id}");

        $response->assertExactJson(
            [
                'success' => 'Contato excluído com sucesso!',
            ]
        );

    }

    public function test_delete_not_found()
    {

        $response = $this->deleteJson("/api/v1/employee/destroy/fake_value");
        $response->assertStatus(HttpResponse::HTTP_NOT_FOUND);
    }

}
