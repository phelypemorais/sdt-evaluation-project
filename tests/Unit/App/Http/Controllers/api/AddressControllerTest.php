<?php

namespace Tests\Unit\App\Http\Controllers\api;

use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\Contracts\ContactModelInterface;
use Mockery;
use Tests\TestCase;
use stdClass;
use Illuminate\Support\Str;

class ContactControllerTest extends TestCase
{
      

    public function testContactIndex()
    {
    
    $mock = Mockery::mock(stdClass::class, ContactModelInterface::class);
    $mock->shouldReceive('getAllContacts')
    ->once()
    ->andReturn([
        "name" => "Top Way System"
        ]);

    $contactController = new ContactController($mock);
    
    $result = $contactController->index();
  
    $this->assertSame(json_encode(
            ["name" => "Top Way System"],
        ), $result->getContent(), '');
    
   
}
       
public function testFindContact()
{
    $mock1 = Mockery::mock(stdClass::class, ContactModelInterface::class);

    $mock1->shouldReceive('GetByIdContacts')
    ->once()
    ->with("07859194-1db9-40af-880f-dd4a3c49a4e7")
    ->andReturn(["name" => "Phelype Morais"]);


    $controllerContact = new ContactController($mock1);
    
    $result = $controllerContact->find("07859194-1db9-40af-880f-dd4a3c49a4e7");

    $this->assertSame(json_encode(
        ["name" => "Phelype Morais"],
        ), $result->getContent(), '');
}

public function testCreateContact() 
{

    $contact = new stdClass;
    $contact->uuid = Str::uuid();
    $contact->name = 'Rogério';
    
    $array = json_decode(json_encode($contact), true);
    
    $mock  = Mockery::mock(stdClass::class, ContactModelInterface::class);

    $mock->shouldReceive('createContacts')
    ->once()
    ->with($array)
    ->andReturn(stdClass::class);
   
    $controller = new ContactController($mock);

    $result = $controller->create($array);


    $this->assertSame(json_encode(
        ["success" => "Contato criado com sucesso!"],
    ),$result->getContent(), '');


}

public function testUpdateContact()
{

    $contact = new stdClass;
    $contact->uuid = Str::uuid();
    $contact->name = "Rogério";
   
    
    $array = json_decode(json_encode($contact), true);

    $mock = Mockery::mock(stdClass::class, ContactModelInterface::class);
    
    $mock->shouldReceive('updateContacts')
    ->once()
    ->with("321e5123-58bb-4fd3-a58c-91a960f3940d", $array)
    ->andReturn(true);

    $controller = new ContactController($mock);
    $result = $controller->update("321e5123-58bb-4fd3-a58c-91a960f3940d", $array);

    $this->assertSame(json_encode(
        ["success" => "Contato atualizado com sucesso!"],
    ),$result->getContent(), '');
}

public function testDeleteContact()
{
    $mock = Mockery::mock(stdClass::class, ContactModelInterface::class);
    
    $mock->shouldReceive('deleteContacts')
    ->once()
    ->with('321e5123-58bb-4fd3-a58c-91a960f3940d')
    ->andReturn(true);

    $controller = new ContactController($mock);
    $result = $controller->destroy('321e5123-58bb-4fd3-a58c-91a960f3940d');

    $this->assertSame(json_encode(
        ["success" => "Contato excluído com sucesso!"],
    ),$result->getContent(), '');

}

protected function tearDown(): void
{
    Mockery::close();

    parent::tearDown();
}
}
