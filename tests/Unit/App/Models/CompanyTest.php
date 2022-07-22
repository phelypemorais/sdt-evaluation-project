<?php

namespace Tests\Unit\App\Models;

use App\Http\Controllers\api\Contracts\CompanyModelInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;

use PHPUnit\Framework\TestCase;



class CompanyTest extends TestCase
{
    protected function model():Model
    {
        return new Company();
    }

   
    
    public function test_fillable()
    {
        $fillable =  $this->model()->getFillable();

        $expected = ['name'];


        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            CompanyModelInterface::class,
            $this->model()
            );
    }


    }