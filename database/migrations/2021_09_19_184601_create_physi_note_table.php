<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysiNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physi_note', function (Blueprint $table) {
            $table->id();
            $table->integer('idEleve');  //Here DS mean devoir surveille and Comp mean subfinal or final exam
            $table->integer('DSone');
            $table->integer('DStwo');
            $table->integer('DStree');
            $table->integer('DSfour');
            $table->integer('DSfive');
            $table->integer('DSsix');
            $table->integer('DSseven');
            $table->integer('DSeigth');
            $table->integer('DSnine');
            $table->integer('DSten');
            $table->integer('DSeleven');
            $table->integer('DStwelve');
            $table->integer('Compone');
            $table->integer('Comptwo');
            $table->integer('Comptree');
            $table->integer('Compfour');
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
        Schema::dropIfExists('physi_note');
    }
}
