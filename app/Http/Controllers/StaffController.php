<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = DB::table('staff')->select('sid', 'staffId', 'username', 'phone', 'erContact', 'erPhone')->take(10)->get();
        return response()->json($users, 200); 
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
		$staff = $request->only('username', 'phone', 'email', 'address', 'baseSalary', 'extraSalary');
		$staff['hourSalary'] = round(($staff['baseSalary'] + $staff['extraSalary'])/30, 0);
		$staff['created_at'] = date('Y-m-d H:i:s');
		DB::table('staff')->insert($staff);
		return response()->json(array('status' => 1, 'result' => $staff), 200);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sid)
    {
        $staff = DB::table('staff')
			->select('sid', 'username', 'phone', 'email', 'address', 'baseSalary', 'extraSalary')
			->where('sid', '=', $sid)->get();
        return response()->json(array('status' => 1, 'result' => $staff), 200);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sid)
    {
        $staff = DB::table('staff')
            ->select('sid', 'username', 'phone', 'email', 'address', 'baseSalary', 'extraSalary')
            ->where('sid', '=', $sid)->first();
        return response()->json(array('status' => 1, 'result' => $staff), 200);    
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
        $staff = $request->only('username', 'phone', 'email', 'address', 'baseSalary', 'extraSalary');
        $staff['hourSalary'] = round(($staff['baseSalary'] + $staff['extraSalary'])/30, 0);
        DB::table('staff')
			->where('sid', $sid)
			->update($staff);
        return response()->json(array('status' => 1), 200);        
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