<?php

namespace Tests\Unit\App\Models;

use App\Http\Controllers\api\Contracts\AddressModelInterface;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

use PHPUnit\Framework\TestCase;



class AddressTest extends TestCase
{
    protected function model():Model
    {
        return new Address();
    }

   
    
    public function test_fillable()
    {
        $fillable =  $this->model()->getFillable();

        $expected = ['street','district','zip_code','number','complement','city','state'];


        $this->assertEquals($expected, $fillable);
        
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            AddressModelInterface::class,
            $this->model()
            );
    }



    }