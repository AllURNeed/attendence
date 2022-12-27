<?php

namespace App\Http\Controllers;

use App\Models\AdminMdl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use SESSION;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request){
       // dd($request->all());

        $request->validate([
            "Username"=>"required",
            "Password"=>"required"
        ]);

        $data = DB::table('adminlogin')->where(['username'=>"$request->Username",'password'=>md5("$request->Password")])->select()->get();
        if(count($data) > 0){
            $data = $data[0];
            
            session([
                "type"=>"admin",
                "username"=>$data->username,
                "school"=>$data->school,
                "school_time"=>$data->school_time
            ]);

            return redirect('/dashboard');

        }else{
            return redirect()->back()->with('message','Invalid Username OR Password');
        }

    }

    public function logout(){
        
        session()->flush();
        
        return redirect('/');
        exit();

    }

    public function index()
    {
        //
        return view('dashboard');
    }

    public function addapi(){
        return view('addapi');
    }

    public function saveapi(Request $request){
       // dd($request->all());
        $request->validate([
            "type"=>"required",
            "api"=>"required"
        ]);

        $exist = DB::table('api')->select()->where('api_type',"$request->type")->get();
        if(count($exist) > 0){
            return redirect()->back()->with('message','Record Already Exist :(');
        }else{
            DB::table('api')->insert([
                "api_type"=>$request->type,
                "api"=>urlencode($request->api),
                "created_at"=>date('Y-m-d H:i:s'),
                "updated_at"=>date('Y-m-d H:i:s')
            ]);    
            return redirect()->back()->with('message','Api Save Successfully');
        }

       
    }

    public function ViewApi(){
        $data = DB::table('api')->orderBy('ID','DESC')->select()->get();
        return view('viewapi',compact('data'));
    }

    public function delete($id){
       DB::table('api')->where('id','=',$id)->delete();
       return redirect()->back()->with('message','Api Delete Successfully');
    }

    public function api_status($id,$cur){
        DB::table('api')->where('id',$id)->update([
            'status'=>$cur
        ]);
        return redirect()->back()->with('message','Api Status Update Successfully');
    }

    public function setting(){
        return view('setting');
    }

    public function set_setting(Request $request){
       $request->validate([
            "school"=>"required",
            "time"=>"required",
            "username"=>"required"
        ]);
        if(isset($request->password) && $request->password!=''){
            DB::table('adminlogin')->update([
                "password"=>md5("$request->password")
            ]);
        }

        DB::table('adminlogin')->update([
            "username"=>$request->username,
            "school"=>$request->school,
            "school_time"=>$request->time
        ]);

        session([
            "username"=>$request->username,
            "school"=>$request->school,
            "school_time"=>$request->time
        ]);
        
        return redirect()->back()->with('message','Record Update Successfully');
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminMdl  $adminMdl
     * @return \Illuminate\Http\Response
     */
    public function show(AdminMdl $adminMdl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminMdl  $adminMdl
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminMdl $adminMdl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminMdl  $adminMdl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminMdl $adminMdl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminMdl  $adminMdl
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminMdl $adminMdl)
    {
        //
    }
}
