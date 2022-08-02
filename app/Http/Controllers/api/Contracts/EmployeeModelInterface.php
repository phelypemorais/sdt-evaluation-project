<?php

namespace App\Http\Controllers\api\Contracts;

use App\Http\Requests\StoreUpdateEmployeeRequest;

interface EmployeeModelInterface
{
    public function contacts();
    public function address();
    public function company();
    //CRUD
    public function getAllEmployees();
    public function createEmployees(iterable $data);
    public function GetByIdEmployees($id);
    public function updateEmployees($id, $data);
    public function deleteEmployees($id);


}
