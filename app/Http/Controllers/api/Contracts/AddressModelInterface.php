<?php

namespace App\Http\Controllers\api\Contracts;

interface AddressModelInterface
{

    public function addressable();
    public function clients();
    public function company();

    //CRUD
    public function getAllAddresses();
    public function createAddresses(Iterable $data);
    public function GetByIdAddresses(string $id);
    public function updateAddresses(string $id, iterable $data);
    public function deleteAddresses(string $id);

}
