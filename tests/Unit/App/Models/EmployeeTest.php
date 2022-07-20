<?php

namespace Tests\Unit\App\Models;

use App\Http\Controllers\api\Contracts\EmployeeModelInterface;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class EmployeeTest extends TestCase
{
    protected function model():Model
    {
        return new Employee();
    }

   
    
    public function test_fillable()
    {
        $fillableEmployee =  $this->model()->getFillable();

        $expected = ['name', 'charge'];


        $this->assertEquals($expected, $fillableEmployee);
    }

    // public function test_create()
    // {
    //     $createEmployee = $this->model()->create();

    // }

    }