<?php

namespace Tests\Feature\App\Models;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    protected function model():Model
    {
        return new Company();
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
            CompanyModelInterface::class,
            $this->model()
            );
    }


    public function test_create()
    {
        $data = [
           
            'name' => 'Top Way Systems',
           
        ];

           $response = new Company();
           $response->createCompanies($data);
    

    $this->assertNotNull($response);
}    
    
}
