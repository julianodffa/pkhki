<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructureOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');  // Nama
            $table->string('position');  // Posisi
            $table->string('lawfirm');  // Firma hukum
            $table->string('email')->unique();  // Email, harus unik
            $table->string('image')->nullable();  // Image, nullable jika tidak ada gambar
            $table->foreignId('role_id')->contrained()->cascadeOnDelete();
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
        Schema::dropIfExists('structure_organizations');
    }
}
