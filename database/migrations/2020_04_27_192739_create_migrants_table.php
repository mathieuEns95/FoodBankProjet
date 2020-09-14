<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('migrants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('pays');
            $table->string('date_naissance');
            $table->string('passeport')->unique();
            $table->string('profession');
            $table->string('adresse');
            $table->integer('nbre_coloc');
            $table->integer('nbre_enfants');
            $table->string('telephone');
            $table->string("qr_code")->nullable();
            $table->integer("solvability");
            $table->string("token")->nullable();
            $table->string('email')->unique();
            $table->string("date_creation");
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
        Schema::dropIfExists('migrants');
    }
}
