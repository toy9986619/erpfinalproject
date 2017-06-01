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
		$month=date("m");
		$time=$year.'-'.$month;

		$staff=DB::table('staff')->get();	//get all staff
		$staffNum=count($staff);			//get staff numbers
		$recordResult=array();

			for($j=0; $j<$staffNum; $j++){

                $time = DB::table('record')
                    ->select('created_at')
                    ->where('username', '=', $staff[$j]->username)
                    ->max('created_at');
                $searchTime=substr($time, 0, 10);

                $record = DB::table('record')
                    ->select('created_at')
                    ->where('username', '=', $staff[$j]->username)
                    ->where('created_at', 'like', "$searchTime%")
                    ->get();

				$recordNum=count($record);

                if($recordNum==0)   continue;
				else if($recordNum==1){
				$firstRecordTime=substr($record[0]->created_at, -8);
                $lastRecordTime=substr($record[0]->created_at, -8);
                }else{
                $firstRecordTime=substr($record[0]->created_at, -8);
				$lastRecordTime=substr($record[$recordNum-1]->created_at, -8);
				}

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
			
		//}
		return response()
			->json($recordResult, 200);
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
		$year=date("Y");
		$month=date("m");
		$time = $year."-".$month;
        $days=date('t', mktime(0, 0, 0, $month, 1, $year));

        $recordResult=array();

		$staff = DB::table('staff')
				->where('sid', $sid)
				->get();
        //echo $staff[0]->sid;
        
        for($i=1; $i<=$days; $i++){
            if($i<10) $searchTime=$time.'-0'.$i;
            else        $searchTime=$time.'-'.$i;

		    $record = DB::table('record')
			    ->select('rid', 'staffId', 'rfid', 'username', 'created_at')
			    ->where('created_at', 'like', "$searchTime%")
			    ->where('staffId', $staff[0]->staffId)
			    ->get();

            $recordNum=count($record);

            if($recordNum==0)   continue;
            else if($recordNum==1){
                $firstRecordTime=substr($record[0]->created_at, -8);
                $lastRecordTime=substr($record[0]->created_at, -8);
            }else{
                $firstRecordTime=substr($record[0]->created_at, -8);
                $lastRecordTime=substr($record[$recordNum-1]->created_at, -8);
            }

            $temp=array(
                "sid"   =>  $sid,
                "staffId" => $staff[0]->staffId,
                "username" => $staff[0]->username,
                "date" => $searchTime,
                "first" => $firstRecordTime,
                "last" => $lastRecordTime
            );
                
            array_push($recordResult, $temp);
        }

		return response()->json($recordResult, 200);
	   
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		//facebook上線~~~~
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
