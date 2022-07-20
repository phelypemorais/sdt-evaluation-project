<?php 

namespace App\Http\Controllers\api\Contracts;

interface ClientModelInterface
{
   
    public function addresses();
    public function contacts();
    public function companies();
    //CRUD
    public function getAllClients();
    public function createClients(Iterable $data);
    public function GetByIdClients($id);
    public function updateClients($id, $data);
    public function deleteClients($id);
   
}