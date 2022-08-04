<?php

namespace Tests\Unit\App\Http\Controllers\api;

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\Contracts\AddressModelInterface;
use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Requests\StoreUpdateAddressRequest;
use App\Http\Requests\StoreUpdateCompanyRequest;
use App\Http\Requests\StoreUpdateEmployeeRequest;
use App\Models\Employee;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mockery;
use stdClass;
use Tests\TestCase;
use Illuminate\Support\Str;

class AddressControllerTest extends TestCase
{


    public function testAddressIndex()
    {

        $mockAddress = Mockery::mock(stdClass::class, AddressModelInterface::class);
        $mockAddress->shouldReceive('getAllAddresses')
            ->once()
            ->andReturn(["name" => "The name field is required."]);

        $addressController = new AddressController($mockAddress);

        $result = $addressController->index();

        $this->assertSame(json_encode(
            ["name" => "The name field is required."],
        ), $result->getContent(), '');


    }




    public function test_find_addresses()
    {
        $mock = Mockery::mock(stdClass::class, AddressModelInterface::class);

        $mock->shouldReceive('GetByIdAddresses')
            ->once()
            ->with("321e5123-58bb-4fd3-a58c-91a960f3940d")
            ->andReturn(["street" => "ali",'number'=>'50']);


        $controllerAddress = new AddressController($mock);

        $result = $controllerAddress->find("321e5123-58bb-4fd3-a58c-91a960f3940d");

        $this->assertSame(json_encode(
            ["street" => "ali",'number'=>'50'],
        ), $result->getContent(), '');
    }

    public function testCreateAddress()
    {


        $request = App::make(Request::class);
        $request->merge([

            'street' => '',
            'district' => 'client',
            'zip_code' => "889988998889",
            'number' => '10',
            'complement' => 'ali',
            'city' => 'cariacica',
            'state' => 'ES',
            'addressable_id' => Str::uuid(),
            'addressable_type' => 'clients'

        ]);

        $requestAddress = new StoreUpdateAddressRequest([],$request->all());

        $mock  = Mockery::mock(stdClass::class, AddressModelInterface::class);

        $mock->shouldReceive('createAddresses')
            ->once()
            ->with($requestAddress->all())
            ->andReturn(Request::class);

        $controller = new AddressController($mock);

        $result = $controller->create($requestAddress);


        $this->assertSame(json_encode(
            ["success" => "Endereço criado com sucesso!"],
        ),$result->getContent(), '');


    }

    public function testUpdateAddress()
    {

        $request = App::make(\Illuminate\Http\Request::class);
        $request->merge([
            'street' => 'aqui'
        ]);

        $requestAddress = new StoreUpdateAddressRequest([],$request->all());


        $mock = Mockery::mock(stdClass::class, AddressModelInterface::class);

        $mock->shouldReceive('updateAddresses')
            ->once()
            ->with("321e5123-58bb-4fd3-a58c-91a960f3940d", $requestAddress->all())
            ->andReturn(true);

        $controller = new AddressController($mock);
        $result = $controller->update("321e5123-58bb-4fd3-a58c-91a960f3940d", $requestAddress);

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
