<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Sukoon;
use Validator;
class AdminSukoonController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(){        
        $data = Sukoon::all()->toArray();
        // $columns[0]= ['Header'=>"sh.NO","accessor"=>'hindi'];
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

            'userid'   =>'required',
            
            'title'     =>'required|max:200',
            
            'audio'    =>'required',

            'image'    =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
            $add= new Sukoon;
            $add->user_id=$request->input('userid'); 
            $add->title=$request->input('title');
            if($request->hasfile('audio'))
            {
                $file=$request->file('audio');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->audio=url('')."/admin_assets/upload/".$filename;
            } 
            if($request->hasfile('image'))
            {
                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $filename=rand(10,99).time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->image=url('')."/admin_assets/upload/".$filename;
            } 
            $add->save();
        if($add){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'Some Error','data'=>[]],$this->errorStatus);
    }

    public function destroy($id)
    {
        $users=Sukoon::findOrFail($id);
        $users->delete();
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Delete successfully'],$this->successStatus); 
    }
}
