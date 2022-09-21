<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->string('client_id_production', 2048);//->default('default');
            $table->string('client_secret_production', 2048);//->default('default');
            $table->string('client_id_homologation', 2048);//->default('default');
            $table->string('client_secret_homologation', 2048);//->default('default');
            $table->unsignedSmallInteger('fine');//->default('123');
            $table->unsignedSmallInteger('interest');//->default('123');
            $table->string('notification_url');
            $table->boolean('sandbox');
            // $table->foreign('type_id')->references('id')->on('banking_types');
            $table->enum('type', ['gerencianet']);
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
        Schema::dropIfExists('bankings');
    }
}
