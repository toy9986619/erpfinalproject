<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
	public function jsontest(){
		$staff=array();
	    $test=array(
			"usname"=>"name1",
			"value"=>"1"
		);

	    array_push($staff,$test);
	    $test=array(
			"usname"=>"name2",
			"value"=>"2"
		);
		array_push($staff, $test);

		return response()->json($staff);
	}
}
