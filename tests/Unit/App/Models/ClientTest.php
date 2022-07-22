<?php

namespace Tests\Unit\App\Models;

use App\Http\Controllers\api\Contracts\ClientModelInterface;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

use PHPUnit\Framework\TestCase;



class ClientTest extends TestCase
{
    protected function model():Model
    {
        return new Client();
    }

   
    
    public function testfillable()
    {
        $fillableEmployee =  $this->model()->getFillable();

        $expected = ['name'];


        $this->assertEquals($expected, $fillableEmployee);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            ClientModelInterface::class,
            $this->model()
            );
    }



    }