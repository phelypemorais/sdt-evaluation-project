<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $address;
    
    public function __construct(Address $address)
    {
        $this->address = $address;
        
    }

    public function index()
    {
        
        return response()->json($this->address->getAllAddresses(), 200);
    }

    public function create(Request $request)
    {
        $this->address->createAddresses($request->all());
        return response()
        ->json([
            'success' => 'Endereço criado com sucesso!'
        ]);
    }

    public function find(Request $request)
    {
         
         return response()->json($this->address->GetByIdAddresses($request->id),200);
    }

    public function update( Request $request)
    {
         $this->address->updateAddresses($request->id, $request->all());

         return response()->json([
                'success' => 'Endereço atualizado com sucesso!'                
         ]);
    }

    public function destroy(Request $request)
    {
         $this->address->deleteAddresses($request->id);
         
         return response()->json([
            'success' => 'Funcionario excluído com sucesso!'
         ]);
    }
}
