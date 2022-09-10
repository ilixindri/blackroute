<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingBilletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banking_billets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('carnet_id');
            $table->foreign('carnet_id')->references('id')->on('banking_carnets');
            $table->bigInteger('charge_id');
            $table->smallInteger('parcel');
            $table->string('status');
            $table->integer('value');
            $table->date('expire_at');
            $table->string('url')->comment('link responsivo da parcela (lâmina) do Bolix (carnê)');
            $table->string('parcel_link')->comment('link da parcela (lâmina) do Bolix (carnê)')->nullable();
            $table->string('pdf_charge');
            $table->string('barcode');
            $table->string('pix_qrcode')->nullable();
            $table->text('pix_qrcode_image')->nullable();
            $table->unsignedSmallInteger('fine');
            $table->unsignedSmallInteger('interest');
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
        Schema::dropIfExists('banking_billets');
    }
}
