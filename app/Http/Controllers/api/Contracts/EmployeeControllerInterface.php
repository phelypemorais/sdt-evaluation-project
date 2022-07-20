<?php

namespace App\Http\Controllers\api\Contracts;





interface EmployeeControllerInterface{

    public function index();
    public function create(iterable $data);
    public function find(string $id);
    public function update(string $id, iterable $data);
    public function destroy(string $id);
}