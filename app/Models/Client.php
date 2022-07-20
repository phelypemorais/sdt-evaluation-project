<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\ClientModelInterface;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model implements ClientModelInterface
{
    use HasFactory, GeneratePrimaryKeyUuid;

    protected $fillable = ['name',];
   
    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
    
    public function companies()
    {
        return $this->belongsToMany(Company::class,);
    }


    //CRUD

    public function getAllClients()
    {
        return $this->all();
    }

    public function createClients(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdClients($id)
    {
        return $this->find($id);
    }

    public function updateClients($id, $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteClients($id)
    {
        return $this->where('id',$id)->delete();
    }

}
