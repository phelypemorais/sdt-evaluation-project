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
    public function GetByIdEmployees(string $id);
    public function updateEmployees(string $id, iterable $data);
    public function deleteEmployees(string $id);


}
