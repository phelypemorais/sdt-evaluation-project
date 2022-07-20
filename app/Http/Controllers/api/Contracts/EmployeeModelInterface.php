<?php

namespace App\Http\Controllers\api\Contracts;

interface EmployeeModelInterface
{
    public function contacts();
    public function address();
    public function company();
    //CRUD
    public function getAllEmployees();
    public function createEmployees($data);
    public function GetByIdEmployees($id);
    public function updateEmployees($id, $data);
    public function deleteEmployees($id);

}
