<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{
		$month=date("m", strtotime("-1 month"));
		$year=date("Y", strtotime("-1 month"));
		$time=$year.$month;

        $staff=DB::table('staff')->get();
        $staffNum = count($staff);

		$salarys = DB::table('salary')
			->join('staff', 'salary.username', '=', 'staff.username')
			->select('salary.id', 'salary.salarytime', 'staff.sid', 'salary.staffId', 'salary.username', 'salary.allworktime', 'salary.salary', 'salary.extra', 'salary.allsalary', 'salary.exception','salary.remark')
			->where('salarytime', '=', $time)->take(10)->get();
		return response()->json(array('count'=>$staffNum, 'result'=>$salarys), 200);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			$salary=DB::table('salary')
				->select('salarytime', 'staffId','username','salary','extra','allsalary', 'exception', 'remark')
			->where('id','=',$id)->first();
			return response()->json($salary ,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$salary=$request->only('salary', 'extra');
		$pay=DB::table('salary')
			->where('id','=',$id)
			->value('salary');
		$salary['allsalary']=$pay+$salary['extra'];
		/* 
		 * $pay=DB::table('salary')
		 * 		->where('id','=',$id)
		 * 		->get();
		 *
		 * $salary['allsalary']=$pay->salary+$salary['extra'];
		*/
		DB::table('salary')
			->where('id','=',$id)
			->update($salary);
		return response()->json(['status'=>1], 200);
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
