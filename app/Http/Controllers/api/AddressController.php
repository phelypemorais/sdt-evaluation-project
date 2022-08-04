<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Contracts\AddressModelInterface as Model;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateAddressRequest;


class AddressController extends Controller
{
    protected $address;

    public function __construct(Model $address)
    {
        $this->address = $address;

    }

    public function index()
    {

        return response()->json($this->address->getAllAddresses(), 200);
    }

    public function create(StoreUpdateAddressRequest $request)
    {
        $this->address->createAddresses($request->all());
        return response()
        ->json([
            'success' => 'Endereço criado com sucesso!'
        ]);
    }

    public function find( string $id)
    {

         return response()->json($this->address->GetByIdAddresses($id),200);
    }

    public function update( string $id, StoreUpdateAddressRequest $request)
    {
         $this->address->updateAddresses($id, $request->all());

         return response()->json([
                'success' => 'Endereço atualizado com sucesso!'
         ]);
    }

    public function destroy(string $id)
    {
         $this->address->deleteAddresses($id);

         return response()->json([
            'success' => 'Endereço excluído com sucesso!'
         ]);
    }
}
