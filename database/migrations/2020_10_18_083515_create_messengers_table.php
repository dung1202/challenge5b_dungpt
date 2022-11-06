<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messengers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_to')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('user_from')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('parent_id')->default(0);
            $table->string('messenger');
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
        Schema::dropIfExists('messengers');
    }
}
