<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class Company extends Model implements CompanyModelInterface
{
    use HasFactory, GeneratePrimaryKeyUuid;

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class,);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class,'contactable');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class,);
    }


    //CRUD

    public function getAllCompanies()
    {
        return $this->paginate(10);
    }

    public function createCompanies(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdCompanies(string $id)
    {
        $company = $this->find($id);
        abort_if(
            !isset($company),
            Response::HTTP_NOT_FOUND,
            'Cliente não encontrado'
        );
        return $company;
    }


    public function updateCompanies(string $id, iterable $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteCompanies(string $id):bool
    {
        return $this->where('id',$id)->delete();
    }

}
