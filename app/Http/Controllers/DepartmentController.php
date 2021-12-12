<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
     function getDepartmentList(Request $request){
   
        //return "Welcome!! to your Dashboard";
        
        //$data = array();
        $data['title']= "Department";
        $data['name']= "Department list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'department/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","UserType"=>"department","Code"=>"", "Name"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","UserType"=>"department","Code"=>"", "Name"=>""];
            // $this->DepartmentAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "DepartmentID"=>"","DepartmentData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('department.list', $data);
                 //dd($data);
        }
       
   
    } 
    function DepartmentAddModal(Request $request)
    {


        $info['title']="Department [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('department.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveDepartment(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "UserType" => $request->UserType,
                "Code" => $request->Code,
                "Name" => $request->Name,
                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'department/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Department update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Department update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getDepartmentList($request);
          
        }
    
   

}
