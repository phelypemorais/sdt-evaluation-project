<?php

namespace App\Http\Controllers\api\Contracts;

interface ContactModelInterface{
    
    public function contactable();
    //CRUD
    public function getAllContacts();
    public function createContacts(Iterable $data);
    public function GetByIdContacts($id);
    public function updateContacts($id, $data);
    public function deleteContacts($id);
  
    
    
}
