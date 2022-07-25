<?php

namespace Tests\Feature\App\Models;

use App\Http\Controllers\api\Contracts\AddressModelInterface;
use App\Http\Controllers\api\Contracts\ContactModelInterface;
use App\Models\Address;
use App\Models\Contact;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AddressTest extends TestCase
{
    use RefreshDatabase;

    protected $model;

    protected function setUp(): void
    {
        $this->model = new Address();


        parent::setUp();
    }


    public function test_fillable()
    {
        

        $expected = ['street',
        'district',
        'zip_code',
        'number',
        'complement',
        'city',
        'state',];

        $fillable =  $this->model->getFillable();


        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            AddressModelInterface::class,
            $this->model
        );
    }


    public function test_create()
    {
     //$employee = Employee::factory()->create();
     //dd($employee);   
     $data = [
        'street'=> 'la',
        'district'=> 'lala',
        'zip_code'=> '29476328',
        'number'=> '25',
        'complement' => 'rua tal tal',
        'city' => 'cidade',
        'state' =>'estado',
     ];
      

       $response = $this->model->createAddresses($data);

        $this->assertNotNull($response);
    }
    
    public function test_find_all()
    {
        $data = [
            'street'=> 'la',
        'district'=> 'liaaa',
        'zip_code'=> '29476328',
        'number'=> '25',
        'complement' => 'rua tal tal',
        'city' => 'cidade',
        'state' =>'estado',
         ];
        
        $this->model->create($data);

        
        $response = $this->model->getAllAddresses();

        $this->assertCount(1,$response);
    }

    public function test_fin_all()
    {
        $data = [
        'street'=> 'la',
        'district'=> 'Rua Da Matriz n 37',
        'zip_code'=> '29476328',
        'number'=> '25',
        'complement' => 'rua tal tal',
        'city' => 'cidade',
        'state' =>'estado',
         ];
        
        $this->model->create($data);

        $response = $this->model->getAllAddresses();

        $this->assertCount(1,$response);
    }

    // public function test_update()
    // {
          
          
    //       $data = [
    //         'number' => '99228481',
    //         'contactable_type' => 'company',
    //         'contactable_id' => "889988998889"
    //      ];

    //      $contact = $this->model->create($data);


    //     $att = [
    //         'number' => '(254) 623-9618',
    //     ];

    //     $response = $this->model->updateContacts($contact->id,$att);

    //     $this->assertNotNull($response);
    //     $this->assertDatabaseHas('contacts',[
    //         'number' => '(254) 623-9618',
    //     ]);

    // }

    // public function test_delete()
    // {
    //     $data = [
    //         'number' => '99228481',
    //         'contactable_type' => 'company',
    //         'contactable_id' => "889988998889"
    //      ];

    //      $contact = $this->model->create($data);

    //     $deleted = $this->model->deleteContacts($contact->id);

    //     $this->assertTrue($deleted);
    //     $this->assertDatabaseMissing('contacts',[
    //         'id' => $contact->id
    //     ]);
    // }


    }
