<?php

namespace App\Models;

use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::enforceMorphMap([
    'client' => 'App\Models\Client',
    'employee' => 'App\Models\Employee',
    'company' => 'App\Models\Company',
]);
 
class Contact extends Model
{
    use HasFactory, GeneratePrimaryKeyUuid; 

    protected $fillable = ['number'];
    
    public function contactable()
    {
        return $this->morphTo();
    }


    //CRUD

    public function getAllContacts()
    {
        return $this->all();
    }

    public function createContacts(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdContacts($id)
    {
        return $this->find($id);
    }

    public function updateContacts($id, $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteContacts($id)
    {
        return $this->where('id',$id)->delete();
    }

}

