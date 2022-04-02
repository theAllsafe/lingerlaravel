<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizzInfo;
use App\Models\Answer;
use Validator;
class QuizzInfoController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(){        
        $data = QuizzInfo::first();
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function store(Request $request)
    {
        $rules = [

            'type'          =>'required',
            
            'english'       =>'required',

            'hindi'         =>'required',
            
            'roman'         =>'required',

            'urdu'          =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $data = QuizzInfo::where("type",$request->input('type'))->first();
        if($data)
        {
            $add= QuizzInfo::find($data->id);
            $add->type=$request->input('type');
            $add->english=$request->input('english'); 
            $add->hindi=$request->input('hindi');
            $add->roman=$request->input('roman'); 
            $add->urdu=$request->input('urdu');     
            $add->update();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'update successfully','data'=>$add],$this->successStatus); 
        }
        else
        {
            $add= new QuizzInfo;
            $add->type=$request->input('type');
            $add->english=$request->input('english'); 
            $add->hindi=$request->input('hindi');
            $add->roman=$request->input('roman'); 
            $add->urdu=$request->input('urdu');       
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->errorStatus);
    }


    public function result(Request $request,$id){
        $type=$id;
        $data=[];
        
        if($type==1){
            $data['result']=Answer::join('tbl_questios','tbl_answer.question_id','=','tbl_questios.id')
                                    ->join('users','tbl_answer.user_id','=','users.id')
                                    ->selectRaw('count(user_id) as point,sum(tbl_answer.time) as total_time,name,users.id,users.image,users.mobile_no,users.email')
                                    ->groupBy('tbl_answer.user_id','users.name','users.id','users.image','users.mobile_no','users.email')
                                    ->orderBy('total_time','desc')
                                    // ->where('tbl_questios.date',date("d-m-Y"))
                                    ->get();
        }
        if($type==2){
            $date7 = \Carbon\Carbon::today()->subDays(7);
            // print_r($date7); exit;
            $data['result']=Answer::join('tbl_questios','tbl_answer.question_id','=','tbl_questios.id')
                                ->join('users','tbl_answer.user_id','=','users.id')
                                ->selectRaw('count(user_id) as point,sum(tbl_answer.time) as total_time,name')
                                ->groupBy('tbl_answer.user_id','users.name')
                                ->orderBy('total_time','desc')
                                // ->whereRaw('DATE(tbl_questios.created_at) = DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
                                ->get();
        }
        if($type==3){
            $data['result']=Answer::join('tbl_questios','tbl_answer.question_id','=','tbl_questios.id')
                                ->join('users','tbl_answer.user_id','=','users.id')
                                ->selectRaw('count(user_id) as point,sum(tbl_answer.time) as total_time,name')
                                ->groupBy('tbl_answer.user_id','users.name')
                                ->orderBy('total_time','desc')
                                // ->where('tbl_questios.date',date("d-m-Y"))
                                ->get();
        }
        if($type==10){
            $data['result']=Answer::join('tbl_questios','tbl_answer.question_id','=','tbl_questios.id')
                                ->join('users','tbl_answer.user_id','=','users.id')
                                ->selectRaw('count(user_id) as point,sum(tbl_answer.time) as total_time,name')
                                ->groupBy('tbl_answer.user_id','users.name')
                                ->orderBy('total_time','desc')
                                // ->where('tbl_questios.date',date("d-m-Y"))
                                ->limit(10)
                                ->get();
        }
               
        if( count( $data ) > 0 ){
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data Found','data'=>$data],$this->successStatus);
            
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Data Not Found' ] , $this->errorStatus );
        
        }
        
    }
}
