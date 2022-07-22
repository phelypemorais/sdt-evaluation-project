<?php

namespace Tests\Feature\App;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModelsEmployeeTest extends TestCase
{
    protected $model, $data;

    protected function setUp(): void
    {
        $this->model = new Employee();
        

        parent::setUp();
    }

    // protected function model():Model
    // {
    //     return new Employee();
    // }

   
    
    public function test_fillable()
    {
        $fillableEmployee =  $this->model->getFillable();

        $expected = ['name', 'charge', 'company_id'];


        $this->assertEquals($expected, $fillableEmployee);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            EmployeeModelInterface::class,
            $this->model
            );
    }

    public function test_create()
    {
       $company =  Company::factory()->create();

        $data = [
           
            'name' => 'phelype morais',
            'charge' => 'developer',
            'company_id' => $company->id
        ];

        $response =  $this->model->createEmployees($data);
          
        //$this->assertEquals($data,$response);

    $this->assertNotNull($response);
    }

    // public function test_find_all()
    // {
    //  Employee::factory()->count(10)->create(); 
        
       
    //    $model = new Employee();
    //     $resposta = $model->all();

    //     $this->assertCount(10,$resposta);
    // }



 }

