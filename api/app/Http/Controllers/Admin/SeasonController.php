<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use Validator;
class SeasonController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(){        
        $data = Season::get();
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

            'seasonname'       =>'required',
            
            'seasondate'       =>'required',

            'seasonweek'       =>'required',
            
            'seasonques'       =>'required',

            'seasontime'       =>'required',

            'seasonday'        =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
            $add= new Season;
            $add->season_name=$request->input('seasonname');
            $add->season_date=$request->input('seasondate'); 
            $add->season_week=$request->input('seasonweek');
            $add->season_ques=$request->input('seasonques'); 
            $add->season_time=$request->input('seasontime');
            $add->season_day = $request->input('seasonday');       
            $add->save();
        if($add){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'Some Error','data'=>[]],$this->errorStatus);
    }
}
