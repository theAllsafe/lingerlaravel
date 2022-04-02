<?php

namespace App\Http\Controllers\AppApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use DB;
use Mail;
use App\Models\User_details;

class ResetPasswordController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;

    public function reset_password_mobile(Request $request)
    {      

        $rules = [

            'mobile_no'            =>'required|min:7'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        } 

        if( User::where('mobile_no',$request->mobile_no)->first() ){
               
            $update['otp']= rand(100000,999999);
            $detail=User::where('mobile_no', $request->mobile_no)->update($update);
            $user = User::where('mobile_no', $request->mobile_no)->first();
            $user_details = User::join('tbl_user_details','tbl_user_details.user_id','=','users.id')->where( 'users.id',$user->id )->select('users.*','tbl_user_details.total_like','tbl_user_details.total_followers','tbl_user_details.total_following','tbl_user_details.fecebook_account_link','tbl_user_details.instagram_account_link','tbl_user_details.twitter_account_link')->first();
            $apiToken=$user->createToken('token')->accessToken;
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'OTP sent to above mobile number','user'=>$user_details,'token'=>$apiToken],$this->successStatus);
            
        }
        else{
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Wrong mobile number'],$this->successStatus);
        
        }
        
    }

    public function reset_password_email(Request $request)
    {      

        $rules = [

            'email'            =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        } 

        if( User::where('email',$request->email)->first() ){
               
            $update['otp']= rand(100000,999999);
            $detail=User::where('email',$request->email)->update($update);
            $user = User::where('email',$request->email)->first();
            $user_details = User::join('tbl_user_details','tbl_user_details.user_id','=','users.id')->where( 'users.id',$user->id )->select('users.*','tbl_user_details.total_like','tbl_user_details.total_followers','tbl_user_details.total_following','tbl_user_details.fecebook_account_link','tbl_user_details.instagram_account_link','tbl_user_details.twitter_account_link')->first();
            $apiToken=$user->createToken('token')->accessToken;
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'OTP sent to above email','user'=>$user_details,'token'=>$apiToken],$this->successStatus);
            
        }
        else{
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Wrong email id'],$this->successStatus);
        
        }
        
    }

    public function update_password(Request $request)
    {      

        $rules = [

            'uid'            =>'required',

            'new_password'   =>'required',

            'new_confirm_password'=> 'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        } 

        if($request->new_password==$request->new_confirm_password)
        {               
            $update['password']= Hash::make($request->new_password);
            $detail=User::where('id',$request->uid)->update($update);
            $user = User::where('email',$request->email)->first();
            $user_details = User::join('tbl_user_details','tbl_user_details.user_id','=','users.id')->where( 'users.id',$user->id )->select('users.*','tbl_user_details.total_like','tbl_user_details.total_followers','tbl_user_details.total_following','tbl_user_details.fecebook_account_link','tbl_user_details.instagram_account_link','tbl_user_details.twitter_account_link')->first();
            $apiToken=$user->createToken('token')->accessToken;
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'change password successful','user'=>$user_details,'token'=>$apiToken],$this->successStatus);
            
        }
        else{
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'password and confirm password not match'],$this->successStatus);
        
        }
        
    }


}
