<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('staff', function(Blueprint $table){
			$table->increments('sid');
            $table->string('staffId', 10);
            $table->string('rfid', 20);
            
            $table->string('username', 10);
            $table->string('password', 64);
            $table->string('phone', 10);
            $table->string('email', 30);
            $table->string('address', 128);
            $table->string('erContact', 10);
            $table->string('erPhone', 10);

            $table->string('baseSalary', 10);
            $table->string('extraSalary', 10);
            $table->string('hourSalary', 10);
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
        Schema::drop('staff');
    }
}
