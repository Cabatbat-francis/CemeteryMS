<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->string("firstname");
            $table->string("middlename")->nullable();
            $table->string("lastname");
            $table->tinyInteger("isMale", 2);
            $table->date("birthdate")->nullable();
            $table->date("deathdate")->nullable();
            $table->string("contact_no")->nullable();
            $table->slug("user_id")->nullable();
            $table->slug("father_id")->nullable();
            $table->slug("mother_id")->nullable();
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
        Schema::dropIfExists('persons');
    }
}
