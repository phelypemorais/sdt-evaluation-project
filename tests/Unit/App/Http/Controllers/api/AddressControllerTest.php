<?php

namespace Tests\Unit\App\Http\Controllers\api;

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\Contracts\AddressModelInterface;
use Mockery;
use Tests\TestCase;
use stdClass;
use Illuminate\Support\Str;

class AddressControllerTest extends TestCase
{
      

    public function testAddressIndex()
    {
    
    $mock = Mockery::mock(stdClass::class, AddressModelInterface::class);
    $mock->shouldReceive('getAllAddresses')
    ->once()
    ->andReturn([
        "name" => "Top Way System"
        ]);

    $addressController = new AddressController($mock);
    
    $result = $addressController->index();
  
    $this->assertSame(json_encode(
            ["name" => "Top Way System"],
        ), $result->getContent(), '');
    
   
}
       
public function testFindAddress()
{
    $mock1 = Mockery::mock(stdClass::class, AddressModelInterface::class);

    $mock1->shouldReceive('GetByIdAddresses')
    ->once()
    ->with("07859194-1db9-40af-880f-dd4a3c49a4e7")
    ->andReturn(["name" => "Phelype Morais"]);


    $controllerAddress = new AddressController($mock1);
    
    $result = $controllerAddress->find("07859194-1db9-40af-880f-dd4a3c49a4e7");

    $this->assertSame(json_encode(
        ["name" => "Phelype Morais"],
        ), $result->getContent(), '');
}

public function testCreateAddress() 
{

    $address = new stdClass;
    $address->uuid = Str::uuid();
    $address->name = 'Rogério';
    
    $array = json_decode(json_encode($address), true);
    
    $mock  = Mockery::mock(stdClass::class, AddressModelInterface::class);

    $mock->shouldReceive('createAddresses')
    ->once()
    ->with($array)
    ->andReturn(stdClass::class);
   
    $controller = new AddressController($mock);

    $result = $controller->create($array);


    $this->assertSame(json_encode(
        ["success" => "Endereço criado com sucesso!"],
    ),$result->getContent(), '');


}

public function testUpdateAddress()
{

    $address = new stdClass;
    $address->uuid = Str::uuid();
    $address->name = "Rogério";
   
    
    $array = json_decode(json_encode($address), true);

    $mock = Mockery::mock(stdClass::class, AddressModelInterface::class);
    
    $mock->shouldReceive('updateAddresses')
    ->once()
    ->with("321e5123-58bb-4fd3-a58c-91a960f3940d", $array)
    ->andReturn(true);

    $controller = new AddressController($mock);
    $result = $controller->update("321e5123-58bb-4fd3-a58c-91a960f3940d", $array);

    $this->assertSame(json_encode(
        ["success" => "Endereço atualizado com sucesso!"],
    ),$result->getContent(), '');
}

public function testDeleteAddress()
{
    $mock = Mockery::mock(stdClass::class, AddressModelInterface::class);
    
    $mock->shouldReceive('deleteAddresses')
    ->once()
    ->with('321e5123-58bb-4fd3-a58c-91a960f3940d')
    ->andReturn(true);

    $controller = new AddressController($mock);
    $result = $controller->destroy('321e5123-58bb-4fd3-a58c-91a960f3940d');

    $this->assertSame(json_encode(
        ["success" => "Endereço excluído com sucesso!"],
    ),$result->getContent(), '');

}

protected function tearDown(): void
{
    Mockery::close();

    parent::tearDown();
}
}
