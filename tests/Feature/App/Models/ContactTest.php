<?php

namespace Tests\Feature\App\Models;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Http\Controllers\api\Contracts\ContactModelInterface;
use App\Models\Address;
use App\Models\Client as ModelsClient;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Employee;
use http\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

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
        

        $expected = ['number', 'contactable_id', 'contactable_type'];

        $fillable =  $this->model->getFillable();


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
     //$employee = Employee::factory()->create();
     //dd($employee);   
     $data = [
        'number' => '99228481',
        'contactable_type' => 'company',
        'contactable_id' => "889988998889"
     ];
      

       $response = $this->model->createContacts($data);

        $this->assertNotNull($response);
    }
    
    public function test_find_all()
    {
        $data = [
            'number' => '99228481',
            'contactable_type' => 'company',
            'contactable_id' => "889988998889"
         ];
        
        $this->model->create($data);

        
        $response = $this->model->getAllContacts();

        $this->assertCount(1,$response);
    }

    public function test_update()
    {
          
          
          $data = [
            'number' => '99228481',
            'contactable_type' => 'company',
            'contactable_id' => "889988998889"
         ];

         $contact = $this->model->create($data);


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
        $data = [
            'number' => '99228481',
            'contactable_type' => 'company',
            'contactable_id' => "889988998889"
         ];

         $contact = $this->model->create($data);

        $deleted = $this->model->deleteContacts($contact->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('contacts',[
            'id' => $contact->id
        ]);
    }


    }
