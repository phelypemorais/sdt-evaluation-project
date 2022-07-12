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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamps();
        });


        Schema::create('client_company', function (Blueprint $table) {
            $table->foreignUuid('client_id')->constrained('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignUuid('company_id')->constrained('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->primary([
                'client_id',
                'company_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_company');
        Schema::dropIfExists('clients');
    }
};
