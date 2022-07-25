<?php

namespace Tests\Unit\App\Models;

use App\Http\Controllers\api\Contracts\ContactModelInterface;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;

use PHPUnit\Framework\TestCase;



class ContactTest extends TestCase
{
    protected $data;
    protected function setUp(): void
    {
        // $this->model = new Contact();
        $this->data = [
            'name' => 'phelype morais',
            'charge' => 'developer',
            
        ];

        parent::setUp();
    }

    protected function model():Model
    {
        return new Contact();
    }

   
    
    public function test_fillable()
    {
        $fillable =  $this->model()->getFillable();

        $expected = ['number', 'contactable_id',  'contactable_type'];


        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            ContactModelInterface::class,
            $this->model()
            );
    }
//     public function test_create()
//     {
    

//     $response = new Contact();
//     $response->createContacts($this->data);

//     $this->assertNotNull($response);
// }


    }