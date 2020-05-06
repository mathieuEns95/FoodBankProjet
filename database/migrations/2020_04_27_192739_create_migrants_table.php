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
            $table->string("cni");
            $table->string("nom");
            $table->string("email");
            $table->string("prenom");
            $table->string("telephone");
            $table->string("adresse");
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
