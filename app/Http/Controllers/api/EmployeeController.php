<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface ;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller 
{
    protected $employee;
    
    public function __construct(EmployeeModelInterface $employee)
    {
        $this->employee = $employee;
        
    }

    public function index()
    {
     return response()->json($this->employee->getAllEmployees(), 200);
    
    }

    public function create($data)
    {
        
         $this->employee->createEmployees($data);
      
        return response()
         ->json([
             'success' => 'Funcionário criado com sucesso!'
        ]);
    }

    public function find(string $id)
    {
         
         return response()->json($this->employee->GetByIdEmployees($id),200);
    }

    public function update(string $id, iterable $data)
    {
      $this->employee->updateEmployees($id, $data);

         return response()->json([
                'success' => 'Funcionário atualizado com sucesso!'                
         ]);
    }

    public function destroy(string $id)
    {
         $this->employee->deleteEmployees($id);
         
         return response()->json([
            'success' => 'Funcionário excluído com sucesso!'
         ]);
    }

    
}
