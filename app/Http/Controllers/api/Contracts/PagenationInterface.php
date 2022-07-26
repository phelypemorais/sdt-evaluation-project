<?php

namespace App\Http\Controllers\api\Contracts;

interface PagenationInterface 
{
   
    public function items():array;
    public function total(): int;
     

}
