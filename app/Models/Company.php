<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->all();
    }

    public function createCompanies(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdCompanies($id)
    {
        return $this->find($id);
    }

    public function updateCompanies($id, $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteCompanies($id):bool
    {
        return $this->where('id',$id)->delete();
    }

}
