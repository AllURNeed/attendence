<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
class NodeScript extends Controller
{
    //
    public function in(){
        $msg = DB::table('api')->select('api')->where(['api_type'=>'in','status'=>1])->get();
        $msg = $msg[0];
        $msg = urldecode($msg->api);        
        //echo $mm = $msg;

        $school = DB::table('adminlogin')->select('school','school_time')->get();        
        $schoolName = $school[0]->school;
        $time = $school[0]->school_time;

        $bmsg = explode("{#var#}",$msg);
        $att =  DB::table('users_logs')->select()->where('in_attendence',0)->where('out_attendence',0)->where('checkindate',date('Y-m-d'))->limit(1)->Get();
               
        if(count($att) > 0){
            $att = $att[0]; 
            if($time > $att->timein){
                $msg = $bmsg[0]."IN";
            }else{
                $msg = $bmsg[0]."Late";
            }            
           
            $msg.= $bmsg[1].$att->username;
            $msg.= $bmsg[2].$schoolName;
            $msg.= $bmsg[3].date('Y-m-d');
            $msg.= $bmsg[4].$att->timein;
            $msg.= $bmsg[5];
            $msg = urlencode($msg);

            // select mobile no.
            $mbl = DB::table('users')->select('email')->where('username',$att->username)->Get();
            $mbl = $mbl[0];
            $mbl = $mbl->email;
            $url = "http://101.53.147.61/index.php/smsapi/httpapi/?uname=vidyak&password=123123&sender=MAISAG&tempid=1607100000000239692&receiver=$mbl&route=TA&msgtype=1&sms=$msg";
            file_get_contents($url);
            // udpate record 
            $up =  DB::table('users_logs')->where('id',$att->id)->update([
                        "in_attendence"=>1
                    ]);
        }
    }

    public function out(){
        $msg = DB::table('api')->select('api')->where(['api_type'=>'Out','status'=>1])->get();
        $msg = $msg[0];
        $msg = urldecode($msg->api);        
        //echo $mm = $msg;

        $school = DB::table('adminlogin')->select('school','school_time')->get();        
        $schoolName = $school[0]->school;
        $time = $school[0]->school_time;

        $bmsg = explode("{#var#}",$msg);
        $att =  DB::table('users_logs')->select()->where('in_attendence',1)->where('out_attendence',0)->where('checkindate',date('Y-m-d'))->limit(1)->Get();
               
        if(count($att) > 0){
            $att = $att[0]; 
            $msg = $bmsg[0]."Out";          
           
            $msg.= $bmsg[1].$att->username;
            $msg.= $bmsg[2].$schoolName;
            $msg.= $bmsg[3].date('Y-m-d');
            $msg.= $bmsg[4].$att->timeout;
            $msg.= $bmsg[5];
            $msg = urlencode($msg);

            // select mobile no.
            $mbl = DB::table('users')->select('email')->where('username',$att->username)->Get();
            $mbl = $mbl[0];
            $mbl = $mbl->email;
            $url = "http://101.53.147.61/index.php/smsapi/httpapi/?uname=vidyak&password=123123&sender=MAISAG&tempid=1607100000000239692&receiver=$mbl&route=TA&msgtype=1&sms=$msg";
            file_get_contents($url);
            // udpate record 
            $up =  DB::table('users_logs')->where('id',$att->id)->update([
                        "out_attendence"=>1
                    ]);
        }
    }
}
