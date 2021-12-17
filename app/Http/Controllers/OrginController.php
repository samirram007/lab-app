<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class OriginController extends Controller
{
     function getOriginList(Request $request){

        $data['title']= "Origin";
        $data['name']= "Origin list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'origin/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"origin","Code"=>"", "Name"=>"", "ContactNo1"=>"",
                "ContactNo2"=>"", "Address"=>"", "Email"=>"", "DateofFoundation"=>"", "CELicenseNo"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"origin","Code"=>"", "Name"=>"",
              "ContactNo1"=>"", "ContactNo2"=>"", "Address"=>"", "Email"=>"", "DateofFoundation"=>"", "CELicenseNo"=>""];
            // $this->OriginAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "OriginID"=>"","OriginData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('origin.list', $data);
                 //dd($data);
        }
       
   
    } 
    function OriginAddModal(Request $request)
    {


        $info['title']="Origin [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('origin.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveOrigin(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "Name" => $request->Name,
                "ContactNo1" => $request->ContactNo1,
                "ContactNo2" => $request->ContactNo2,
                "Address" => $request->Address,
                "Email" => $request->Email,
                "DateofFoundation" => $request->DateofFoundation,
                "CELicenseNo" => $request->CELicenseNo,
                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'origin/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Origin update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Origin update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getOriginList($request);
          
        }
    
   

}