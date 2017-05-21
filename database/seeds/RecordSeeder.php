<?php

use Illuminate\Database\Seeder;
class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		DB::table('record')->truncate();
		/////上班
		for($i=1;$i<=10;$i++){
			DB::table('record')->insert([
				'staffId'=>DB::table('staff')->where('sid',$i)->value('staffId'),
				'rfid'=>DB::table('staff')->where('sid',$i)->value('rfid'),
				'username'=>DB::table('staff')->where('sid',$i)->value('username'),
				'created_at'=>('2017-05-21 09:00:00'),	
			]);
			DB::table('record')->insert([
				'staffId'=>DB::table('staff')->where('sid',$i)->value('staffId'),
				'rfid'=>DB::table('staff')->where('sid',$i)->value('rfid'),
				'username'=>DB::table('staff')->where('sid',$i)->value('username'),
				'created_at'=>('2017-05-21 20:00:00'),
			]);
		}
	}
}
