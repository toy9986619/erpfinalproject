<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use App\Salary;

class WorktimeController extends Controller
{
	public function countSalary(){		
		$staff=DB::table('staff')->get();	//get all staff
		$staffNum=count($staff);			//get staff numbers
		$year=date("Y");					//get years
		$month=date("m") -1;				//get month(last month)
		if($month == 0){	$month = 12; $year=$year-1;}  //fix month
		if($month <10)	$month = '0'.$month;		//fix month
		$days = date('t', mktime(0, 0, 0, $month, 1, $year));	//get days
		
		
		//for all staff
		for($i=0; $i<$staffNum; $i++){		
			$exception="";		//record days with error
			$hours=0;			//worktimes
			$overtimes=0;		//workovertimes
			$holidaytimes=0;	//holiday work times

			$baseSalary = DB::table('staff')
				->where('staffId', $staff[$i]->staffId)
				->value('hourSalary');
			$staffSalary=0;		//salary
			$salary = new Salary;	//database
			
			

			for($j=1; $j<=$days; $j++){
				$rate=1;

				//get time start
				if($j<10)	$time1=$year.'-'.$month.'-0'.$j." 00:00:00";
				else	$time1=$year.'-'.$month.'-'.$j." 00:00:00";
				//get time end
				if($j<10)	$time2=$year.'-'.$month.'-0'.$j." 23:59:59";
				else	$time2=$year.'-'.$month.'-'.$j." 23:59:59";
				
				//get day of the week	
				$weekDay=date('l', mktime(0, 0, 0, $month, $j, $year));

				if($weekDay=="Saturday" || $weekDay=="Sunday")
					$rate=2;
				
				
				
				//search the records
				$record = DB::table('record')
					->where('staffId', $staff[$i]->staffId)
					->whereBetween('created_at', [$time1, $time2])
					->get();
				
				//get record numbers
				$recordNum=count($record);


				//count worktimes
				if($recordNum>1){
					$t1 = StrToTime(
					 (substr($record[0]->created_at, 0, -2).'00'));
					$t2 = StrToTime( 
					 (substr($record[$recordNum-1]->created_at, 0, -2).'00') );
					$diff = $t2 - $t1;
					$diff2 = 0;		//record overtimes
					$diff = round($diff / (60*60), 2);
					
					//if diff < 1 hour => error record
					if($diff<1){
						$diff = 0;
						$exception=$exception.$j." ";
					}
					
					//fix the rest time: 1 hour
					if($diff>=9)	$diff--;
				
					//overtime
					if($diff>=9)	{
						$diff2=$diff-8;
						$overtimes += $diff2;
						$diff=8;	
					}
					$hours = $hours + $diff;

					//count Salary
						//holiday
					
					if($rate==2){
						
						$staffSalary = $staffSalary
							+($diff+$diff2)* $baseSalary*2;
						$hours = $hours - $diff;
						$overtimes = $overtimes - $diff2;
						$holidaytimes = $holidaytimes + $diff + $diff2;
					
					}
					
					

						//normal day
					else{
						$staffSalary=$staffSalary + $diff * $baseSalary;
						for($z=1; $z<=$diff2; $z=$z+0.5){
							if($z<=2){
						  	  $staffSalary=$staffSalary +$baseSalary*0.5*1.33;
					 		}
					 		else if($z<5){
					 	 	  $staffSalary=$staffSalary +$baseSalary*0.5*1.66;
					 		}
					 		else  $staffSalary=$staffSalary + $baseSalary*0.5*2;
						}
					}

				}
				

				//error record
				else if($recordNum==1){
					$exception=$exception.$j." ";
				}
				
			}

			
			//write in database
			$salary->salarytime="$year$month";
			$salary->staffId=$staff[$i]->staffId;
			$salary->username=$staff[$i]->username;
			$salary->worktime=$hours;
			$salary->workovertime=$overtimes;
			$salary->salary=$staffSalary;
			$salary->holidayworktime=$holidaytimes;
			$salary->allworktime=$hours+$overtimes+$holidaytimes;
			$salary->allsalary=$staffSalary;
			$salary->exception=$exception;
			$salary->save();
			
			
		}
	
		echo "done";
	}
}
