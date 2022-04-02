<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\User;
use App\Models\LibraryAudio;
use Validator;
class LibraryAudioController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;

    public function index(){        
        $data = LibraryAudio::all()->toArray();
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

            'uid'   =>'required',
            
            'title' =>'required',

            'icon'  =>'required',
            
            'image' =>'required',

            'audio' =>'required',            

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
            $add= new LibraryAudio;
            $add->uid=$request->input('uid'); 
            $add->title=$request->input('title');
            if($request->hasfile('icon'))
            {
                $file=$request->file('icon');
                $extension=$file->getClientOriginalExtension();
                $filename=uniqid().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->icon=url('')."/admin_assets/upload/".$filename;
            } 
            if($request->hasfile('audio'))
            {
                $file=$request->file('audio');
                $extension=$file->getClientOriginalExtension();
                $filename=uniqid().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->audio=url('')."/admin_assets/upload/".$filename;
            } 
            if($request->hasfile('image'))
            {
                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $filename=uniqid().time().'.'.$extension;
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
        $users=LibraryAudio::findOrFail($id);
        $users->delete();
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Delete successfully'],$this->successStatus); 
    }
}
