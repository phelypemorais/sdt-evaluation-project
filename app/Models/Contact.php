<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\ContactModelInterface;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Response;

Relation::enforceMorphMap([
    'client' => 'App\Models\Client',
    'employee' => 'App\Models\Employee',
    'company' => 'App\Models\Company',
]);

class Contact extends Model implements ContactModelInterface
{
    use HasFactory, GeneratePrimaryKeyUuid;

    protected $fillable = ['number', 'contactable_id',  'contactable_type'];

    public function contactable()
    {
        return $this->morphTo();
    }


    //CRUD

    public function getAllContacts()
    {
        return $this->paginate(10);
    }

    public function createContacts(iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdContacts(string $id)
    {
        $contact = $this->find($id);
        abort_if(
            !isset($contact),
            Response::HTTP_NOT_FOUND,
            'Contato não encontrado'
        );
        return $contact;
    }

    public function updateContacts($id, $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteContacts($id):bool
    {
        return $this->where('id',$id)->delete();
    }

}


