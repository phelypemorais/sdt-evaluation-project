<?php

namespace Tests\Unit\App\Http\Controllers\api;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Http\Controllers\api\EmployeeController;
use App\Models\Employee;
use Mockery;
use stdClass;
use Tests\TestCase;
use Illuminate\Support\Str;



class EmployeeControllerTest extends TestCase
{
   
    

    public function testEmployeeIndex()
    {
    
    $mockEmployee = Mockery::mock(stdClass::class, EmployeeModelInterface::class);
    $mockEmployee->shouldReceive('getAllEmployees')
    ->once()
    ->andReturn(["name" => "The name field is required."]);

    $employeeController = new EmployeeController($mockEmployee);

    $result = $employeeController->index();

    $this->assertSame(json_encode(
            ["name" => "The name field is required."],
        ), $result->getContent(), '');
    
        
}
       



public function test_find_employees()
{
    $mock = Mockery::mock(stdClass::class, EmployeeModelInterface::class);

    $mock->shouldReceive('GetByIdEmployees')
    ->once()
    ->with("321e5123-58bb-4fd3-a58c-91a960f3940d")
    ->andReturn(["name" => "Phelype Morais",'Charge'=>'Developer']);


    $controllerEmployee = new EmployeeController($mock);
    
    $result = $controllerEmployee->find("321e5123-58bb-4fd3-a58c-91a960f3940d");

    $this->assertSame(json_encode(
        ["name" => "Phelype Morais",'Charge'=>'Developer'],
        ), $result->getContent(), '');
}

public function testCreateEmployee() 
{

    $employee = new stdClass;
    $employee->uuid = Str::uuid();
    $employee->name = "Phelype";
    $employee->charge = "Developer";
    $employee->company_id = Str::uuid();
    
    $array = json_decode(json_encode($employee), true);
    
    $mock  = Mockery::mock(stdClass::class, EmployeeModelInterface::class);

    $mock->shouldReceive('createEmployees')
    ->once()
    ->with($array)
    ->andReturn(stdClass::class);
   
    $controller = new EmployeeController($mock);

    $result = $controller->create($array);


    $this->assertSame(json_encode(
        ["success" => "Funcionário criado com sucesso!"],
    ),$result->getContent(), '');


}

public function testUpdateEmployees()
{

    $employee = new stdClass;
    $employee->name = "Phelype";
    $employee->charge = "Developer";
    $employee->company_id = Str::uuid();
    
    $array = json_decode(json_encode($employee), true);

    $mock = Mockery::mock(stdClass::class, EmployeeModelInterface::class);
    
    $mock->shouldReceive('updateEmployees')
    ->once()
    ->with("321e5123-58bb-4fd3-a58c-91a960f3940d", $array)
    ->andReturn(true);

    $controller = new EmployeeController($mock);
    $result = $controller->update("321e5123-58bb-4fd3-a58c-91a960f3940d", $array);

    $this->assertSame(json_encode(
        ["success" => "Funcionário atualizado com sucesso!"],
    ),$result->getContent(), '');
}

public function testDeleteEmployees()
{
    $mock = Mockery::mock(stdClass::class, EmployeeModelInterface::class);
    
    $mock->shouldReceive('deleteEmployees')
    ->once()
    ->with('321e5123-58bb-4fd3-a58c-91a960f3940d')
    ->andReturn(true);

    $controller = new EmployeeController($mock);
    $result = $controller->destroy('321e5123-58bb-4fd3-a58c-91a960f3940d');

    $this->assertSame(json_encode(
        ["success" => "Funcionário excluído com sucesso!"],
    ),$result->getContent(), '');

}




protected function tearDown(): void
{
    Mockery::close();

    parent::tearDown();
}

}