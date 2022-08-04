<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Contracts\ContactModelInterface as Model;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateContactRequest;
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

    public function create(StoreUpdateContactRequest $request)
    {
        $this->contact->createContacts($request->all());
        return response()
        ->json([
            'success' => 'Contato criado com sucesso!'
        ]);
    }

    public function find(string $id)
    {

         return response()->json($this->contact->GetByIdContacts($id),200);
    }

    public function update(string $id, StoreUpdateContactRequest $request)
    {
         $this->contact->updateContacts($id, $request->all());

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
