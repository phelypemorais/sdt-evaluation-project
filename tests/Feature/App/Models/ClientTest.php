<?php

namespace Tests\Feature\App\Models;

use App\Http\Controllers\api\Contracts\ClientModelInterface;
use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected $model;

    protected function setUp(): void
    {
        $this->model = new Client();


        parent::setUp();
    }


    public function test_fillable()
    {
        $fillable =  $this->model->getFillable();

        $expected = ['name'];


        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            ClientModelInterface::class,
            $this->model
            );
    }


    public function test_create()
    {
        $data = [

            'name' => 'Mariana',
            

        ];

        $response = $this->model->createClients($data);


        $this->assertNotNull($response);
    }
    public function test_find_all()
    {
          Client::factory()->create();


        $response = $this->model->getAllClients();

        $this->assertCount(1,$response);
    }

    public function test_update()
    {
        $client =  Client::factory()->create();



        $att = [
            'name' => 'Mariana',
        ];

        $response = $this->model->updateClients($client->id,$att);

        $this->assertNotNull($response);
        $this->assertDatabaseHas('clients',[
            'name' => 'Mariana',
        ]);

    }

    public function test_delete()
    {
        $client = Client::factory()->create();


        $deleted = $this->model->deleteClients($client->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('companies',[
            'id' => $client->id
        ]);
    }

}
