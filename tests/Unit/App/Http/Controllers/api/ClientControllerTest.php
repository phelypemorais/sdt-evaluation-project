<?php

namespace Tests\Unit\App\Http\Controllers\api;

use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\Contracts\ClientModelInterface;
use App\Http\Requests\StoreUpdateClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;
use stdClass;
use Illuminate\Support\Str;

class ClientControllerTest extends TestCase
{
      

    public function testClientIndex()
    {
    
    $mock = Mockery::mock(stdClass::class, ClientModelInterface::class);
    $mock->shouldReceive('getAllClients')
    ->once()
    ->andReturn( ["name" => "Top Way System"]);

    $clientController = new ClientController($mock);
    
    $result = $clientController->index();
  
    $this->assertSame(json_encode(
            ["name" => "Top Way System"],
        ), $result->getContent(), '');
    
   
}
       
public function testFindClient()
{
    $mock1 = Mockery::mock(stdClass::class, clientModelInterface::class);

    $mock1->shouldReceive('GetByIdClients')
    ->once()
    ->with("07859194-1db9-40af-880f-dd4a3c49a4e7")
    ->andReturn(["name" => "Phelype Morais"]);


    $controllerClient = new clientController($mock1);
    
    $result = $controllerClient->find("07859194-1db9-40af-880f-dd4a3c49a4e7");

    $this->assertSame(json_encode(
        ["name" => "Phelype Morais"],
        ), $result->getContent(), '');
}

public function testCreateClient() 
{
    $request = App::make(Request::class);
    $request->merge([
                   
         'nome' => 'fulano',
        
     ]);


     $requestClient = new StoreUpdateClientRequest([],$request->all());

    
    $mock  = Mockery::mock(stdClass::class, clientModelInterface::class);

    $mock->shouldReceive('createClients')
    ->once()
    ->with($requestClient->all())
    ->andReturn(stdClass::class);
   
    $controller = new clientController($mock);

    $result = $controller->create($requestClient);


    $this->assertSame(json_encode(
        ["success" => "Cliente criado com sucesso!"],
    ),$result->getContent(), '');


}

// public function testUpdateClient()
// {

//     $client = new stdClass;
//     $client->uuid = Str::uuid();
//     $client->name = "Rogério";
   
    
//     $array = json_decode(json_encode($client), true);

//     $mock = Mockery::mock(stdClass::class, clientModelInterface::class);
    
//     $mock->shouldReceive('updateClients')
//     ->once()
//     ->with("321e5123-58bb-4fd3-a58c-91a960f3940d", $array)
//     ->andReturn(true);

//     $controller = new clientController($mock);
//     $result = $controller->update("321e5123-58bb-4fd3-a58c-91a960f3940d", $array);

//     $this->assertSame(json_encode(
//         ["success" => "Cliente atualizado com sucesso!"],
//     ),$result->getContent(), '');
// }

public function testDeleteClient()
{
    $mock = Mockery::mock(stdClass::class, clientModelInterface::class);
    
    $mock->shouldReceive('deleteClients')
    ->once()
    ->with('321e5123-58bb-4fd3-a58c-91a960f3940d')
    ->andReturn(true);

    $controller = new clientController($mock);
    $result = $controller->destroy('321e5123-58bb-4fd3-a58c-91a960f3940d');

    $this->assertSame(json_encode(
        ["success" => "Cliente excluído com sucesso!"],
    ),$result->getContent(), '');

}

protected function tearDown(): void
{
    Mockery::close();

    parent::tearDown();
}
}
