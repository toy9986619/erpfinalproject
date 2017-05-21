<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('salary', function(Blueprint $table){
			$table->increments('id');
			$table->string('salarytime', 10);
			$table->string('staffId', 10);
			$table->string('username', 10);
			$table->double('worktime', 10, 2);
			$table->double('workovertime', 10, 2);
			$table->double('holidayworktime', 10, 2);
			$table->double('allworktime', 10, 2);
			$table->integer('salary');
			$table->integer('extra');
			$table->integer('allsalary');
			$table->string('exception');
			$table->string('remark');
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
		Schema::drop('salary');
    }
}
