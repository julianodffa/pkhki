<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->text('address');
            $table->string('ktp')->nullable();
            $table->string('photo')->nullable();
            $table->string('institution')->nullable();
            $table->string('position')->nullable();
            $table->string('company_email')->nullable();
            $table->boolean('is_member_of_other_legal_association')->default(false);
            $table->string('immigration_law_consultant_certificate')->nullable();
            $table->json('other_certificates')->nullable();
            $table->boolean('is_accepted_as_member')->default(false);
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
        Schema::dropIfExists('members');
    }
}
