<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('street')->nullable();
            $table->string('district');
            $table->string('zip_code');
            $table->string('number')->default('s/n');
            $table->string('complement');
            $table->string('city');
            $table->string('state');
            $table->nullableUuidMorphs('addressable');
            $table->timestamps();
        });


        Schema::create('addressables', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('address_id')->constrained('addresses');
            $table->uuidMorphs('addressable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addressables');
        Schema::dropIfExists('addresses');
    }
};
