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
    protected $data;
    protected function setUp(): void
    {   
        $this->model = new Address();

        $this->data = [
            'street'=> 'la',
            'district'=> 'lala',
            'zip_code'=> '29476328',
            'number'=> '25',
            'complement' => 'rua tal tal',
            'city' => 'cidade',
            'state' =>'estado',
         ]; 

        

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
        'state',
        'address_id',
            'address_type'
            ];

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
     
        

       $response = $this->model->createAddresses($this->data);

        $this->assertNotNull($response);
    }

    public function test_find_all()
    {

        $this->model->create($this->data);


        $response = $this->model->getAllAddresses();

        $this->assertCount(1,$response);
    }

    public function test_fin_all()
    {
        

        $this->model->create($this->data);

        $response = $this->model->getAllAddresses();

        $this->assertCount(1,$response);
    }

    public function test_update()
    {

        

        $address = $this->model->create($this->data);


        $att = [
            'number' => '30',
        ];

        $response = $this->model->updateAddresses($address->id,$att);

        $this->assertNotNull($response);
        $this->assertDatabaseHas('addresses',[
            'number' => '30',
        ]);

    }

    public function test_delete()
    {

         $address = $this->model->create($this->data);

        $deleted = $this->model->deleteAddresses($address->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('contacts',[
            'id' => $address->id
        ]);
    }


    }
