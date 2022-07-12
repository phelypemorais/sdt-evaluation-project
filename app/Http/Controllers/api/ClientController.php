<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
        
    }

    public function index()
    {
        
        return response()->json($this->client->getAllClients(), 200);
    }

    public function create(iterable $data)
    {
        $this->client->createClients($data);
        return response()
        ->json([
            'success' => 'Cliente criado com sucesso!'
        ]);
    }

    public function find(string $id)
    {
         
         return response()->json($this->client->GetByIdClients($id),200);
    }

    public function update(string $id, iterable $data)
    {
         $this->client->updateClients($id, $data);

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
