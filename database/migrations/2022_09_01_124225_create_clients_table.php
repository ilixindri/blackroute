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
            $table->tinyInteger('expire_at')->comment('dia de vencimento');
            $table->tinyInteger('until_days')->comment('dias para bloqueio apos vencimento');
            $table->string('sexo')->comment('masculino ou feminino');
            $table->foreignId('banking_id')->on('banking');
            $table->foreignId('plan_id')->on('plan');
            $table->foreignId('contract_id')->on('contract');
            $table->boolean('disabled')->default(False);
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
