<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->text('tipo')->comment('Comercial ou Residencial');
            $table->text('cep');
            $table->text('logradouro');
            $table->text('numero');
            $table->text('UF');
            $table->text('complemento')->nullable();
            $table->text('bairro')->nullable();
            // $table->point('coordinates');
            $table->string('coordinates', 100);
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
        Schema::dropIfExists('adresses');
    }
}
