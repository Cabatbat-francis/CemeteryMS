<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorpsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corpses', function (Blueprint $table) {
            $table->slug("burial_id");
            $table->slug("person_id");
            $table->slug("user_id");
            $table->string("location")->nullable();
            $table->string("birthcert");
            $table->string("deathcert");
            $table->date("rented_until")->nullable();
            $table->integer("status")->default("1");
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
        Schema::dropIfExists('corpses');
    }
}
