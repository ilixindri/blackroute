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
            $table->string('client_id_production');
            $table->string('client_secret_production');
            $table->string('client_id_homologation');
            $table->string('client_secret_homologation');
            $table->string('type')->default('gerencia_net');
            $table->date('fine');
            $table->date('interest');
            $table->boolean('sandbox')->default(False);
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
