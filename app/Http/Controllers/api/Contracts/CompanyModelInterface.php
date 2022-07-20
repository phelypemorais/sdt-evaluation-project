<?php

namespace App\Http\Controllers\api\Contracts;

interface CompanyModelInterface{
    
    public function employees();
    public function address();
    public function contacts();
    public function clients();
    //CRUD
    public function getAllCompanies();
    public function createCompanies(Iterable $data);
    public function GetByIdCompanies($id);
    public function updateCompanies($id, $data);
    public function deleteCompanies($id);
  
    
    
}
