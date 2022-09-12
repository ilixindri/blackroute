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
            $table->foreignId('client_id')->on('clients');
            $table->foreignId('carnet_id')->on('banking_carnets');
            $table->bigInteger('charge_id');
            $table->smallInteger('parcel');
            $table->string('status');
            $table->integer('value')->comment("parcel carnê")->nullable();
            $table->integer('total')->comment("boleto")->nullable();
            $table->date('expire_at');
            $table->string('url')->comment('link responsivo da parcela (lâmina) do Bolix (carnê)')->nullable();
            $table->string('link')->comment('link responsivo do boketo gerado')->nullable();
            $table->string('parcel_link')->comment('link da parcela (lâmina) do Bolix (carnê)')->nullable();
            $table->string('billet_link')->comment('link do boleto')->nullable();
            $table->string('pdf_charge');
            $table->string('barcode');
            $table->string('pix_qrcode')->nullable();
            $table->text('pix_qrcode_image')->nullable();
            $table->string('payment')->comment("boleto")->nullable();
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
        Schema::dropIfExists('banking_billets');
    }
}
