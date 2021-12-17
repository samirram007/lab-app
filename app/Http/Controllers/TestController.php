<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
     function getTestList(Request $request){

        $data['title']= "Test";
        $data['name']= "Test list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'test/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"test","Code"=>"", "Name"=>"", "Alias"=>"",
                "TestGroupID"=>"", "TestCategoryID"=>"", "TestDuration"=>"", 
                "Charges"=>"", "StartDate"=>"", "EndDate"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"test","Code"=>"", "Name"=>"",
              "Alias"=>"", "TestGroupID"=>"", "TestCategoryID"=>"", 
              "TestDuration"=>"", "Charges"=>"", "StartDate"=>"", "EndDate"=>""];
            // $this->TestAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "TestID"=>"","TestData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('test.list', $data);
                 //dd($data);
        }
       
   
    } 
    function TestAddModal(Request $request)
    {


        $info['title']="Test [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('test.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveTest(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "Name" => $request->Name,
                "Alias" => $request->Alias,
                "TestGroupID" => $request->TestGroupID,
                "TestCategoryID" => $request->TestCategoryID,
                "TestDuration" => $request->TestDuration,
                "Charges" => $request->Charges,
                "StartDate" => $request->StartDate,
                "EndDate" => $request->EndDate,
                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'test/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Test update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Test update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getTestList($request);
          
        }
    
   

}