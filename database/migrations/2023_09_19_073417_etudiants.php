<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Etudiants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('etudiant',function(Blueprint $table)
       {
        $table->id();
        $table->string ('nom'); 
        $table->string ('prenom'); 
        $table->string ('classe'); 
    $table->timestamps();      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('etudiant');
    }
}
