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
            $table->string("cni")->nullable();
            $table->string("nom");
            $table->string("email")->nullable();
            $table->string("prenom");
            $table->string("telephone")->nullable();
            $table->string("adresse");
            $table->string("qr_code");
            $table->integer("nbre_retraits");
            $table->integer("solvability");
            $table->string("date_creation");
            $table->string("token")->nullable();
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
