<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingCarnetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banking_carnets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->on('clients');
            $table->foreignId('banking_id')->on('bankings');
            $table->bigInteger('carnet_id');
            $table->string('status');
            $table->string('cover');
            $table->string('link')->comment('link responsivo do carnê, de acordo com as repetições');
            $table->string('carnet_link')->comment('link do carnê, de acordo com as repetições')->nullable();
            $table->string('pdf_carnet');
            $table->string('pdf_cover');
            $table->smallInteger('parcels');
            $table->unsignedSmallInteger('fine');
            $table->unsignedSmallInteger('interest');
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
        Schema::dropIfExists('banking_carnets');
    }
}
