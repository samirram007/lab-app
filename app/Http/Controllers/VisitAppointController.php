<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class VisitAppointController extends Controller
{
     function getVisitAppointList(Request $request){
   
        //return "Welcome!! to your Dashboard";
        
        //$data = array();
        $data['title']= "VisitAppoint";
        $data['name']= "VisitAppoint list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'visitappoint/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"visitappoint","Code"=>"", "Name"=>"", "Charges"=> "", "Active"=> "","OutdoorDept"=> ""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"visitappoint","Code"=>"", "Name"=>"", "Charges"=> "", "Active"=> "","OutdoorDept"=> ""];
            // $this->VisitAppointAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "VisitAppointID"=>"","VisitAppointData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('visitappoint.list', $data);
                 //dd($data);
        }
       
   
    } 
    function VisitAppointAddModal(Request $request)
    {


        $info['title']="VisitAppoint [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('visitappoint.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveVisitAppoint(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "Name" => $request->Name,
                "OutdoorDept" => $request->OutdoorDept,
                "Active" => $request-> Active,
                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'visitappoint/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('VisitAppoint update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('VisitAppoint update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getVisitAppointList($request);
          
        }
    
   

}
