<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Contracts\ContactModelInterface as Model;
use App\Http\Controllers\Controller;
use App\Models\Contact;


class ContactController extends Controller
{
    protected $contact;
        
    public function __construct(Model $contact)
    {
        $this->contact = $contact;
        
    }

    public function index()
    {
        
        return response()->json($this->contact->getAllContacts(), 200);
    }

    public function create(iterable $data)
    {
        $this->contact->createContacts($data);
        return response()
        ->json([
            'success' => 'Contato criado com sucesso!'
        ]);
    }

    public function find(string $id)
    {
         
         return response()->json($this->contact->GetByIdContacts($id),200);
    }

    public function update(string $id, iterable $data)
    {
         $this->contact->updateContacts($id, $data);

         return response()->json([
                'success' => 'Contato atualizado com sucesso!'                
         ]);
    }

    public function destroy(string $id)
    {
         $this->contact->deleteContacts($id);
         
         return response()->json([
            'success' => 'Contato excluído com sucesso!'
         ]);
    }
}
