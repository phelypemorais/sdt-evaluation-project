<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\AddressModelInterface;
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

class Address extends Model implements AddressModelInterface
{
    use HasFactory, GeneratePrimaryKeyUuid ;



    protected $fillable = [
        'street',
        'district',
        'zip_code',
        'number',
        'complement',
        'city',
        'state',
        'address_id',
        'address_type'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function clients()
    {
        return $this->morphedByMany(Client::class,'addressables');
    }

    public function company()
    {
        return $this->morphedByMany(Company::class,'addressables');
    }


    //CRUD

    public function getAllAddresses()
    {
        return $this->paginate(10);
    }

    public function createAddresses(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdAddresses(string $id)
    {
        $address=$this->find($id);
        abort_if(
            !isset($address),
            Response::HTTP_NOT_FOUND,
            'Endereço não encontrado'
        );
        return $address;
    }

    public function updateAddresses(string $id, iterable $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteAddresses(string $id):bool
    {
        $address=$this->find($id);
        abort_if(
            !isset($address),
            Response::HTTP_NOT_FOUND,
            'Endereço não existente'
        );

        return $this->where('id', $id)->delete();

    }

}
