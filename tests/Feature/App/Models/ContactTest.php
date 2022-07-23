<?php

namespace Tests\Feature\App\Models;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Http\Controllers\api\Contracts\ContactModelInterface;
use App\Models\Company;
use App\Models\Contact;
use http\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    protected $model;

    protected function setUp(): void
    {
        $this->model = new Contact();


        parent::setUp();
    }


    public function test_fillable()
    {
        $fillable =  $this->model->getFillable();

        $expected = ['number'];


        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            ContactModelInterface::class,
            $this->model
        );
    }


    public function test_create()
    {
        $data = [

            'number' => '(254) 623-9618',

        ];

       $response = $this->model->createContacts($data);


        $this->assertNotNull($response);
    }
    public function test_find_all()
    {
           Contact::factory()->create();


        $response = $this->model->getAllContacts();

        $this->assertCount(1,$response);
    }

    public function test_update()
    {
          $contact = Contact::factory()->create();



        $att = [
            'number' => '(254) 623-9618',
        ];

        $response = $this->model->updateContacts($contact->id,$att);

        $this->assertNotNull($response);
        $this->assertDatabaseHas('contacts',[
            'number' => '(254) 623-9618',
        ]);

    }

    public function test_delete()
    {
        $contact = Contact::factory()->create();


        $deleted = $this->model->deleteContacts($contact->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('contacts',[
            'id' => $contact->id
        ]);
    }
    }
