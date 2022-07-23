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
    protected function model():Model
    {
        return new Client();
    }

   
    
    public function test_fillable()
    {
        $fillable =  $this->model()->getFillable();

        $expected = ['name'];


        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            ClientModelInterface::class,
            $this->model()
            );
    }


    public function test_create()
    {
        $data = [
           
            'name' => 'Gustavo',
           
        ];

           $response = new Client();
           $response->createClients($data);
    

    $this->assertNotNull($response);
}    
    
}
