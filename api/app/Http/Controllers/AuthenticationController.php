<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
class AuthenticationController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function signin( Request $request ){
        
        $rules = [

            'email'          =>'required',

            'password'          =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        }
        $user = User::where( 'email', $request->email )->first();
        if( $user && Hash::check( $request->password, $user->password ) ){
            $apiToken=$user->createToken('auth_token')->accessToken;
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Login successful','user'=>$user,'token'=>$apiToken],$this->successStatus);
            
        }
        
        return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Wrong email and password combination' ] , $this->errorStatus );
        
    }
}
