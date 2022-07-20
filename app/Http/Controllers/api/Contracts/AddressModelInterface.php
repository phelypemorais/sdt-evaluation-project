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
    public function GetByIdAddresses($id);
    public function updateAddresses($id, $data);
    public function deleteAddresses($id);
   
}