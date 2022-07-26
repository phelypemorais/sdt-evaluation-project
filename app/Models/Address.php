<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\AddressModelInterface;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        return $this->all();
    }

    public function createAddresses(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdAddresses($id)
    {
        return $this->find($id);
    }

    public function updateAddresses($id, $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteAddresses($id):bool
    {
        return $this->where('id',$id)->delete();
    }


}
