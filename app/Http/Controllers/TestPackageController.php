<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class TestPackageController extends Controller
{
     function getTestPackageList(Request $request){

        $data['title']= "TestPackage";
        $data['name']= "TestPackage list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'testpackage/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"testpackage","Code"=>"", "Name"=>"", "Alias"=>"",
                "TestArray"=>"", "Charges"=>"", "StartDate"=>"", "EndDate"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"testpackage","Code"=>"", "Name"=>"",
              "Alias"=>"", "TestArray"=>"", "Charges"=>"", "StartDate"=>"", "EndDate"=>""];
            // $this->TestPackageAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "TestPackageID"=>"","TestPackageData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('testpackage.list', $data);
                 //dd($data);
        }
       
   
    } 
    function TestPackageAddModal(Request $request)
    {


        $info['title']="TestPackage [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('testpackage.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveTestPackage(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "Name" => $request->Name,
                "Alias" => $request->Alias,
                "TestArray" => $request->TestArray,                             
                "Charges" => $request->Charges,
                "StartDate" => $request->StartDate,
                "EndDate" => $request->EndDate,
                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'testpackage/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('TestPackage update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('TestPackage update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getTestPackageList($request);
          
        }
    
   

}