<?php

namespace Tests\Unit\App\Http\Controllers\api;

use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use Mockery;
use Tests\TestCase;
use stdClass;
use Illuminate\Support\Str;

class CompanyControllerTest extends TestCase
{
      

    public function testCompanyIndex()
    {
    
    $mock = Mockery::mock(stdClass::class, CompanyModelInterface::class);
    $mock->shouldReceive('getAllCompanies')
    ->once()
    ->andReturn(["name" => "Top Way System"]);

    $companyController = new CompanyController($mock);
    
    $result = $companyController->index();
  
    $this->assertSame(json_encode(
            ["name" => "Top Way System"],
        ), $result->getContent(), '');
    
   
}
       

public function testFindCompany()
{
    $mock1 = Mockery::mock(stdClass::class, CompanyModelInterface::class);

    $mock1->shouldReceive('GetByIdCompanies')
    ->once()
    ->with("07859194-1db9-40af-880f-dd4a3c49a4e7")
    ->andReturn(["name" => "Top Way Systems"]);


    $controllerCompany = new CompanyController($mock1);
    
    $result = $controllerCompany->find("07859194-1db9-40af-880f-dd4a3c49a4e7");

    $this->assertSame(json_encode(
        ["name" => "Top Way Systems"],
        ), $result->getContent(), '');
}

public function testCreateCompany() 
{

    $company = new stdClass;
    $company->uuid = Str::uuid();
    $company->name = "Top Way Systems";
    
    $array = json_decode(json_encode($company), true);
    
    $mock  = Mockery::mock(stdClass::class, companyModelInterface::class);

    $mock->shouldReceive('createCompanies')
    ->once()
    ->with($array)
    ->andReturn(stdClass::class);
   
    $controller = new companyController($mock);

    $result = $controller->create($array);


    $this->assertSame(json_encode(
        ["success" => "Empresa criada com sucesso!"],
    ),$result->getContent(), '');


}

public function testUpdateCompanies()
{

    $company = new stdClass;
    $company->uuid = Str::uuid();
    $company->name = "Top Way Systems";
   
    
    $array = json_decode(json_encode($company), true);

    $mock = Mockery::mock(stdClass::class, companyModelInterface::class);
    
    $mock->shouldReceive('updateCompanies')
    ->once()
    ->with("321e5123-58bb-4fd3-a58c-91a960f3940d", $array)
    ->andReturn(true);

    $controller = new companyController($mock);
    $result = $controller->update("321e5123-58bb-4fd3-a58c-91a960f3940d", $array);

    $this->assertSame(json_encode(
        ["success" => "Empresa atualizada com sucesso!"],
    ),$result->getContent(), '');
}

public function testDeletecompanys()
{
    $mock = Mockery::mock(stdClass::class, companyModelInterface::class);
    
    $mock->shouldReceive('deleteCompanies')
    ->once()
    ->with('321e5123-58bb-4fd3-a58c-91a960f3940d')
    ->andReturn(true);

    $controller = new companyController($mock);
    $result = $controller->destroy('321e5123-58bb-4fd3-a58c-91a960f3940d');

    $this->assertSame(json_encode(
        ["success" => "Empresa excluída com sucesso!"],
    ),$result->getContent(), '');

}

protected function tearDown(): void
{
    Mockery::close();

    parent::tearDown();
}
}
