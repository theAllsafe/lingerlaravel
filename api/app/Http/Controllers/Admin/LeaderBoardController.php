<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use Validator;
class LeaderBoardController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index()
    {     
        $query = User::join('tbl_user_details','tbl_user_details.user_id','=','users.id')->select('users.*','tbl_user_details.total_like','tbl_user_details.total_followers','tbl_user_details.total_following','tbl_user_details.fecebook_account_link','tbl_user_details.instagram_account_link','tbl_user_details.twitter_account_link')->where('users.role','2')->get();
        $array_val=[];
        $pp=[];
        foreach($query as $key => $val)
        {
            $array_val['id'] = ++$key;
            if($val->prime_status==1){
                $array_val['prime_status'] = "Premium";
            }else{
                $array_val['prime_status'] = "Standard";
            }
            $array_val['name'] = $val->name;
            $array_val['email'] = $val->email;
            $array_val['mobile_no'] = $val->mobile_no;
            $array_val['total_like'] = $val->total_like;
            $array_val['total_followers'] = $val->total_followers;
            $array_val['total_following'] = $val->total_following;
            $pp[]=$array_val;
        }
        if($pp){
        $data=$pp;
        }else{
        $data=[]; 
        }
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }
}
