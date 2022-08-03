<?php

namespace App\Models;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Http\Controllers\api\Contracts\PaginationInterface;
use App\Http\Requests\StoreUpdateEmployeeRequest;
use App\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use mysql_xdevapi\Exception;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Employee extends Model implements EmployeeModelInterface
{
    use HasFactory, GeneratePrimaryKeyUuid;

    protected $table = 'employees';

    protected $fillable = ['name', 'charge', 'company_id'];

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }





    public function getAllEmployees()
    {
        return $this->paginate(10);
    }



    public function createEmployees(iterable $data)
    {

        return $this->create($data);
    }

    public function GetByIdEmployees(string $id)
    {
    $employee=$this->find($id);
    abort_if(
        !isset($employee),
        Response::HTTP_NOT_FOUND,
        'Funcionário não encontrado'
    );
    return $employee;
}

    public function updateEmployees(string $id, iterable $data)
    {   
        if (Arr::exists($data, 'company_id')) {
            $company = company::find($data['company_id']);
        abort_if(
            !isset($company),
            Response::HTTP_NOT_FOUND,
            'Empresa não existente'
        );
        }
        
        return $this->where('id', $id)->update($data);
    }

    public function deleteEmployees(string $id):bool
    {
        $employee=$this->find($id);
        abort_if(
            !isset($employee),
            Response::HTTP_NOT_FOUND,
            'Funcionário não existente'
        );
       
        return $this->where('id', $id)->delete();
        
    }


}
