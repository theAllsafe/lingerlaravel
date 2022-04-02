<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeSlot;
use Validator;
class TimeSlotController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index( Request $request ){        
        $data = TimeSlot::where("status",'1')->get();
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

            'starttime'          =>'required',
            
            'endtime'         =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $add= new TimeSlot;
        $add->start_time=$request->input('starttime');
        $add->end_time=$request->input('endtime');       
        $add->save();

        if($add){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->errorStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page=['page_name'=>'Banner'];
        $row=Banner::find($id);
        return view('admin.banner.edit',compact('page','row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validated =$request->validate([
            'title' => 'required|max:60',
            'description' => 'max:150',
            'image' => 'mimes:jpg,png,jpeg|max:10000'
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= Banner::find($id);
        if($request->hasfile('image'))
            {
                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
               // dd($filename);
                $add->image=url('')."/admin_assets/upload/".$filename;
            }
            else{
                $add->image=$request->input('oldimage');;
            }
            
        
        $add->title=$request->input('title');
        $add->description=$request->input('description');
        $add->update();
        return redirect('admin/banner')->with('status','Banner update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=Banner::findOrFail($id);
        $users->delete();
        return back()->with('status','Banner Delete successfully');
    }
    
    public function status(Request $request)
    {
        $id=$request->input('id');
        $add= Banner::find($id);
        $add->status=$request->input('status');
        $add->update();
        echo 0;
    }
}
