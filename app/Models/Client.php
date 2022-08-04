<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\ClientModelInterface;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class Client extends Model implements ClientModelInterface
{
    use HasFactory, GeneratePrimaryKeyUuid;
    protected $table = 'clients';

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
        return $this->paginate(10);
    }

    public function createClients(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdClients($id)
    {
        $client = $this->find($id);
    abort_if(
        !isset($client),
        Response::HTTP_NOT_FOUND,
        'Cliente não encontrado'
    );
    return $client;
    }

    public function updateClients(string $id, iterable $data)
    {

       return $this->where('id',$id)->update($data);
    }

    public function deleteClients($id): bool
    {
        return $this->where('id',$id)->delete();
    }

}
