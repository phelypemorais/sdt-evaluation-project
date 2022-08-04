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
    public function GetByIdCompanies(string $id);
    public function updateCompanies(string $id, iterable $data);
    public function deleteCompanies(string $id);



}
