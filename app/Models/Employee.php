<?php

namespace App\Models;

use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, GeneratePrimaryKeyUuid;
    
    protected $fillable = ['name', 'charge'];

    public function contacts()
    {
        return $this->morphMany(Contact::class,'contactable');
    }
     
    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }



    //CRUD

    public function getAllEmployees()
    {
        return $this->all();
    }

    public function createEmployees(Iterable $data)
    {
        return $this->create($data);
    }

    public function GetByIdEmployees($id)
    {
        return $this->find($id);
    }

    public function updateEmployees($id, $data)
    {
       return $this->where('id',$id)->update($data);
    }

    public function deleteEmployees($id)
    {
        return $this->where('id',$id)->delete();
    }

    
}