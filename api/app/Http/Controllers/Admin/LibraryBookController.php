<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\User;
use App\Models\LibraryBook;
use Validator;
class LibraryBookController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;

    public function index(){        
        $data = LibraryBook::all()->toArray();
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
            
            'bookName' =>'required',

            'bookArabicName'  =>'required',
            
            'image' =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $add= new LibraryBook;
        $add->uid=$request->input('uid'); 
        $add->book_name=strip_tags($request->input('bookName'));
        $add->book_arabic_name=strip_tags($request->input('bookArabicName'));
        if($request->hasfile('image'))
        {
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=uniqid().time().'.'.$extension;
            $file->move('admin_assets/upload',$filename);
            $add->book_image=url('')."/admin_assets/upload/".$filename;
        } 
        $add->save();
        if($add){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'Some Error','data'=>[]],$this->errorStatus);
    }

    public function destroy($id)
    {
        $users=LibraryBook::findOrFail($id);
        $users->delete();
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Delete successfully'],$this->successStatus); 
    }
}
