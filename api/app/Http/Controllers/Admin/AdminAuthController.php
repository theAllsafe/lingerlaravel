<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use DB;
use Mail;
use App\Models\User_details;
use App\Models\Like;
use App\Models\Follow;
class AdminAuthController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;


    public function signin( Request $request ){
        $rules = [

            'email'          =>'required',

            'password'       =>'required|min:6',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        }
        $user = User::where( 'email', $request->email )->orWhere( 'mobile_no', $request->email )->first();
        if( $user && Hash::check( $request->password, $user->password)){
            $otp= rand(1000,9999);
            $data = [
            'otp' => $otp
            ];
            $email = array('email' => $request->input('email'));
            
            // Mail::send('mail', $data, function($message) use ($email){
            //     $message->subject('signin');
            // $message->to($email['email']);
            // $message->from('dheeraj@8bittask.com','Linger');
            // });
            // $data_update[ 'otp' ] = $otp;
            // User::where( ['email'=>$email['email']] )->update( $data_update );
            $user_details = User::where( 'users.id',$user->id )->first();
            $apiToken=$user->createToken('token')->accessToken;
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Login successful','user'=>$user_details,'token'=>$apiToken],$this->successStatus);
            
        }
        
        return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Wrong email and password combination' ] , $this->errorStatus );
        
    }

    
        public function profile_update( Request $request)
        {
        
        $rules = [
            
            'name'          =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'success'=>false, 'message'=>$validation->errors()->first() ] , 200 );

        }
        $data['name'] = $request->name;

        $User_detail['fecebook_account_link']  = $request->fecebook_account_link;
        $User_detail['instagram_account_link'] = $request->instagram_account_link;
        $User_detail['twitter_account_link']   = $request->twitter_account_link;
        
        if( User::where( ['id'=>$request->user()->id,'role'=>'2'] )->update( $data )){
            $detail=User_details::where( ['user_id'=>$request->user()->id] )->update($User_detail);
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Profile update successful','data'=>$User_detail],$this->successStatus);
        
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'!Wrong' ] , $this->errorStatus );
        
        }
        return response( [ 'success'=>false, 'message'=>'Sorry try again' ] , 200 );
        
    }
    
    public function update_profile_image( Request $request)
        {
        
        $rules = [
            
            'image'          =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'success'=>false, 'message'=>$validation->errors()->first() ] , 200 );

        }
        $add= User::find($request->user()->id);
        if($request->hasfile('image'))
        {
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('admin_assets/upload',$filename);
            $add->image=url('')."/admin_assets/upload/".$filename;
        }          
        $add->update();
        
        if($add){
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Update profile image successful','data'=>$add],$this->successStatus);
        
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Sorry not update profile image' ] , $this->errorStatus );
        
        }
        return response( [ 'success'=>false, 'message'=>'Sorry try again' ] , 200 );
        
    }
    
    public function delete_profile_image( Request $request)
        {
        
        $add= User::find($request->user()->id);
        $add->image=Null;      
        $add->update();
        
        if($add){
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Update profile image successful','data'=>$add],$this->successStatus);
        
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Sorry not update profile image' ] , $this->errorStatus );
        
        }
        return response( [ 'success'=>false, 'message'=>'Sorry try again' ] , 200 );
        
    }
    
    public function personal_profile(Request $request)
    {
        
        $user = User::join('tbl_user_details','tbl_user_details.user_id','=','users.id')->where( 'users.id',$request->user()->id )->first();
        if($user)
        {

            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data found','data'=>$user],$this->successStatus);
        
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'!Data not found' ] , $this->errorStatus );
        
        }
        
    }

    public function other_user_profile($id)
    {
        $data['user_detail'] = User::join('tbl_user_details','tbl_user_details.user_id','=','users.id')->where( 'users.id',$id )->first();
        $data['is_like'] = 0;
        $data['is_follow'] = 0;
        if($data)
        {

            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data found','data'=>$data],$this->successStatus);
        
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'!Data not found' ] , $this->errorStatus );
        
        }
        
    }   
    
    public function like(Request $request)
    {
        $rules = [

            'is_user'          =>'required',
            
            'is_like'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $data = Like::where(["this_user"=>$request->user()->id,"is_user"=>$request->input('is_user')])->first();
        if($data)
        {
            $update['is_like']  = $request->is_like;
            $add=Like::where( ["this_user"=>$request->user()->id,"is_user"=>$request->input('is_user')] )->update( $update );
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'update successfully','data'=>$add],$this->successStatus); 
        }
        else
        {
            $add= new Like;
            $add->this_user=$request->user()->id;
            $add->is_user=$request->input('is_user'); 
            $add->is_like=$request->input('is_like');    
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->errorStatus);
    }
    
    public function follow(Request $request)
    {
        $rules = [

            'is_user'          =>'required',
            
            'is_follow'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $data = Follow::where(["this_user"=>$request->user()->id,"is_user"=>$request->input('is_user')])->first();
        if($data)
        {
            $update['is_follow']  = $request->is_follow;
            $add=Follow::where( ["this_user"=>$request->user()->id,"is_user"=>$request->input('is_user')] )->update( $update );
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'update successfully','data'=>$add],$this->successStatus); 
        }
        else
        {
            $add= new Follow;
            $add->this_user=$request->user()->id;
            $add->is_user=$request->input('is_user'); 
            $add->is_follow=$request->input('is_follow');    
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->errorStatus);
    }
}
