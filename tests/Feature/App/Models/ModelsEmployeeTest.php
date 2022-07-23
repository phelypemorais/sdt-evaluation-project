<?php

namespace Tests\Feature\App;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotNull;

class ModelsEmployeeTest extends TestCase
{
    protected $model;
    protected $data;

    protected function setUp(): void
    {
        $this->model = new Employee();


        parent::setUp();
    }

    // protected function model():Model
    // {
    //     return new Employee();
    // }

    use RefreshDatabase;

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

    public function test_find_all()
    {
        $company =  Company::factory()->create();


        $data = [

        'name' => 'phelype morais',
        'charge' => 'developer',
        'company_id' => $company->id
    ];
        $this->model->create($data);

        $response = $this->model->getAllEmployees();

        $this->assertCount(1,$response);
    }

    public function test_update()
    {
        $company =  Company::factory()->create();

        $data = [

            'name' => 'phelype morais',
            'charge' => 'developer',
            'company_id' => $company->id
        ];
            $employee = $this->model->create($data);

        $att = [
            'name' => 'gustavo',
        ];

       $response = $this->model->updateEmployees($employee->id,$att);

       $this->assertNotNull($response);
       $this->assertDatabaseHas('employees',[
        'name' => 'gustavo',
       ]);

    }

    public function test_delete()
    {
        $company = company::factory()->create();

        $data = [
            'name' => 'Phelype Morais',
            'charge' => 'Developer',
            'company_id' => $company->id
        ];

        $employee = $this->model->create($data);

     $deleted = $this->model->deleteEmployees($employee->id);

     $this->assertTrue($deleted);
     $this->assertDatabaseMissing('employees',[
            'id' => $employee->id
     ]);
    }
}
