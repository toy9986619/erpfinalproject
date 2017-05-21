<?php
namespace App\Http\Controllers;
//   use App\User;
   use App\Http\Controllers\Controller;
   use Validator;
   use Auth;
   use Illuminate\Http\Request;
//   use Illuminate\Http\RedirectorResponse;
   use App\Http\Requests;
   class LoginController extends Controller{
	   public function show(){
	   		return view('login');
	   }

	   public function login(Request $request){
		   
		   /*if(Auth::attempt(['email'=>$request->input('user'),'password'=>$request->input('pswd')] )){
		   		return view('home');
	   }*/


			$validator=Validator::make($request->all(),
			   ['user'=>'required|email','pswd'=>'required'] );
			
			if($validator->passes()){
			   $attempt=Auth::attempt(
				   ['email'=>$request->input('user'),'password'=>$request->input('pswd')] );
			   if($attempt){
			   		return redirect()->intended('home');
			   }
			
			   //return redirect('login')
			//	   ->withErrors( ['fail'=>'帳號或密碼錯誤'] );
			}
			return redirect('/login')->withErrors(['status'=>'error']);
		   /*return redirect('login')
			   ->withErrors($validator)
			   ->withInput(Input::except('password'));*/
	   }

	   /*public function logout(){
	  		Auth::logout();
			return redirect('login');
	   *
	   }*/
	}

