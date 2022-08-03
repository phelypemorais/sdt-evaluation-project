<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Contracts\ClientModelInterface as Model;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClientRequest;

class ClientController extends Controller 
{
    protected $client;
    
    public function __construct(Model $client)
    {
        $this->client = $client;
        
    }

    public function index()
    {
        
        return response()->json($this->client->getAllClients(), 200);
    }

    public function create(StoreUpdateClientRequest $request)
    {
        $this->client->createClients($request->all());
        
        return response()
        ->json([
            'success' => 'Cliente criado com sucesso!'
        ]);
    }

    public function find(string $id)
    {
         
         return response()->json($this->client->GetByIdClients($id),200);
    }

    public function update(string $id, StoreUpdateClientRequest $request)
    {
         $this->client->updateClients($id, $request->all());

         return response()->json([
                'success' => 'Cliente atualizado com sucesso!'                
         ]);
    }

    public function destroy(string $id)
    {
         $this->client->deleteClients($id);
         
         return response()->json([
            'success' => 'Cliente excluído com sucesso!'
         ]);
    }
}
