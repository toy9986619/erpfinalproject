<?php

use Illuminate\Database\Seeder;

class ClearSalaryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary')->truncate();	
    }
}
