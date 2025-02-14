<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationTrafficTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_traffic', function (Blueprint $table) {
            $table->id();
            $table->string('slug'); // Identifier publikasi
            $table->string('title');
            $table->string('ip_address');
            $table->string('browser');
            $table->string('device');
            $table->string('os');
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
        Schema::dropIfExists('publication_traffic');
    }
}
