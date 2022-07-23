<?php

namespace Tests\Feature\App\Models;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    protected $model;

    protected function setUp(): void
    {
        $this->model = new Company();


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
            CompanyModelInterface::class,
            $this->model
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
    public function test_find_all()
    {
        $company =  Company::factory()->create();


        $response = $this->model->getAllCompanies();

        $this->assertCount(1,$response);
    }

    public function test_update()
    {
        $company =  Company::factory()->create();



        $att = [
            'name' => 'Privilege',
        ];

        $response = $this->model->updateCompanies($company->id,$att);

        $this->assertNotNull($response);
        $this->assertDatabaseHas('companies',[
            'name' => 'Privilege',
        ]);

    }

    public function test_delete()
    {
        $company = company::factory()->create();


        $deleted = $this->model->deleteCompanies($company->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('companies',[
            'id' => $company->id
        ]);
    }

    /*public function test_delete_not_found()
    {
        $this->expectException(NotFoundExeption::class);
        $this->model->deleteEmployees('fake_id');

    }
    */
}
