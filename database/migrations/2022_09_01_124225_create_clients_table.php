<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('rg');
            $table->string('cpf');
            $table->string('phone');
            $table->string('whatsapp');
            $table->date('birth_date');
            $table->string('user', 256);
            $table->string('password', 4096);
            $table->enum('sex', ['female', 'male']);
            $table->tinyInteger('splitter');
            $table->foreignId('cto_id')->on('cto');
            $table->foreignId('banking_id')->on('banking');
            $table->foreignId('plan_id')->on('plan');
            $table->foreignId('contract_id')->on('contract');
            $table->unsignedTinyInteger('expire_at')->comment('dia de vencimento');
            $table->unsignedSmallInteger('until_days')->comment('dias para bloqueio apos vencimento');
            $table->enum('mode', ['ipoe', 'pppoe']);
            $table->string('ip', 30);
            $table->string('mac');
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
        Schema::dropIfExists('clients');
    }
}
