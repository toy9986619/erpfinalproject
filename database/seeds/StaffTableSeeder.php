<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('staff')->truncate();		
		for($i=1;$i<=10;$i++){
			$staff = factory(App\Staff::class)->create([
				'sid' => $i,
				'hourSalary' => '133'
			]);
		}
    }
}
