<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$year=date("Y");
		$month=date("m", strtotime("-1 month"));
		if($month == 12){	$year=$year-1;}
		$time=$year.'-'.$month;
			
		echo "$time";

		$days = date('t', mktime(0, 0, 0, $month, 1, $year));   //get days


		$staff=DB::table('staff')->get();	//get all staff
		$staffNum=count($staff);			//get staff numbers
		$recordResult=array();

		for($i=1; $i<=$days; $i++){
			for($j=0; $j<$staffNum; $j++){
				//get time
				if($i<10)	$searchTime=$time.'-0'.$i;
				else		$searchTime=$time.'-'.$i;
				
				$record = DB::table('record')
					->join('staff', 'record.staffId', '=', 'staff.staffid')
					->select('record.rid', 'staff.sid', 'record.staffId', 'record.username', 'record.created_at')
					->where('record.username', '=', $staff[$j]->username)
					->where('record.created_at', 'like', "$searchTime%")
					->get();

				$recordNum=count($record);
				//echo "$searchTime $recordNum</br>";

				if($recordNum>0){
				//echo "$searchTime</br>";
				$firstRecordTime=substr($record[0]->created_at, -8);
				$lastRecordTime=substr($record[$recordNum-1]->created_at, -8);
				$temp=array(
					"sid" => $staff[$j]->sid,
					"staffId" => $staff[$j]->staffId,
					"username" => $staff[$j]->username,
					"date" => $searchTime,
					"first" => $firstRecordTime,
					"last" => $lastRecordTime
				);
				
				array_push($recordResult, $temp);
				}
			}
		}

		return response()->json($recordResult, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sid)
    {
		
	}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sid)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
