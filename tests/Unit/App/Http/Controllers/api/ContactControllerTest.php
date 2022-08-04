<?php

namespace Tests\Unit\App\Http\Controllers\api;

use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\Contracts\ContactModelInterface;
use App\Http\Requests\StoreUpdateClientRequest;
use App\Http\Requests\StoreUpdateCompanyRequest;
use App\Http\Requests\StoreUpdateContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

    $request = App::make(Request::class);
    $request->merge([

        'number' => '997550668',

    ]);


    $requestContact = new StoreUpdateContactRequest([],$request->all());

    $mock  = Mockery::mock(stdClass::class, ContactModelInterface::class);

    $mock->shouldReceive('createContacts')
    ->once()
    ->with( $requestContact->all())
    ->andReturn(stdClass::class);

    $controller = new ContactController($mock);

    $result = $controller->create( $requestContact);


    $this->assertSame(json_encode(
        ["success" => "Contato criado com sucesso!"],
    ),$result->getContent(), '');


}

public function testUpdateContact()
{

    $request = App::make(\Illuminate\Http\Request::class);
    $request->merge([
        'number' => '2799228488'
    ]);

    $requestContact = new StoreUpdateContactRequest([],$request->all());


    $mock = Mockery::mock(stdClass::class, ContactModelInterface::class);

    $mock->shouldReceive('updateContacts')
    ->once()
    ->with("321e5123-58bb-4fd3-a58c-91a960f3940d", $requestContact->all())
    ->andReturn(true);

    $controller = new ContactController($mock);
    $result = $controller->update("321e5123-58bb-4fd3-a58c-91a960f3940d", $requestContact);

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
