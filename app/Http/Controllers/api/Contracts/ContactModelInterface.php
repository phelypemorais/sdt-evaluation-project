<?php

namespace App\Http\Controllers\api\Contracts;

interface ContactModelInterface{

    public function contactable();
    //CRUD
    public function getAllContacts();
    public function createContacts(iterable $data);
    public function GetByIdContacts(string $id);
    public function updateContacts(string $id, iterable $data);
    public function deleteContacts(string $id);



}
