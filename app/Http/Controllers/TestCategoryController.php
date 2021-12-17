<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class TestCategoryController extends Controller
{
     function getTestCategoryList(Request $request){

        $data['title']= "TestCategory";
        $data['name']= "TestCategory list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'testcategory/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"testcategory","Code"=>"", "Name"=>"", 
                "TestGroupID"=>"", "MethodArray"=>"" ];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"testcategory","Code"=>"", "Name"=>"",
             "TestGroupID"=>"", "MethodArray"=>""];
            // $this->TestCategoryAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "TestCategoryID"=>"","TestCategoryData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('testcategory.list', $data);
                 //dd($data);
        }
       
   
    } 
    function TestCategoryAddModal(Request $request)
    {


        $info['title']="TestCategory [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('testcategory.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveTestCategory(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "Name" => $request->Name,              
                "TestGroupID" => $request->TestGroupID,
                "MethodArray" => $request->MethodArray,
                
                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'testcategory/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('TestCategory update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('TestCategory update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getTestCategoryList($request);
          
        }
    
   

}