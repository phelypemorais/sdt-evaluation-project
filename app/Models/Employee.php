<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





class Employee extends Model implements EmployeeModelInterface
{
    use HasFactory, GeneratePrimaryKeyUuid;

     protected $table = 'employees';

    protected $fillable = ['name', 'charge', 'company_id'];

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





    public function getAllEmployees()
    {
        return $this->all();
    }

    public function createEmployees(iterable $data)
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

    public function deleteEmployees($id):bool
    {
        return $this->where('id',$id)->delete();
    }


}
