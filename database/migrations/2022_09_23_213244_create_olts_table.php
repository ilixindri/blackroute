<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOltsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->tinyInteger('ports');
            $table->string('ip', 256);
            $table->unsignedSmallInteger('ssh_port');
            $table->string('ssh_user', 4096);
            $table->string('ssh_pass', 16384);
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
        Schema::dropIfExists('olts');
    }
}
