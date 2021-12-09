<?php

namespace App\Http\Controllers;

 
use App\Models\ServiceModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
   //
   public function getServiceList()
   {
      
       $data['info']=[
           "title"=>"Service",
           "name"=>"Service list"
       ];
       $data['collection']=[];
       if (Session::has('loginid')) {
           $json_call_data=[ "ServiceID"=>"all"];
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'service/read', $json_call_data)->json();
           //dd($response);
           if($response['status']){
               $data['collection']=$response['data'];
              //  $data['new']=["MasterID"=>"","MasterType"=>"product","Code"=>"", "Name"=>"", "Price"=>"", "Category"=>""];
            }

           $data['new']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
           "CustomerID"=>"","CustomerData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
          // dd($data);
       }
     
    //    [{"ServiceID":"8f577ae2-ad95-4bc0-b07a-bd6fe3ce41a7","ServiceDate":"2021-11-26 18:03:18",
    //     "CustomerID":"","CustomerData":[],"ProductID":"2b9f0a48-6a74-4183-9dda-01c083d6aec7",
    //     "ProductData":[{"MasterID":"2b9f0a48-6a74-4183-9dda-01c083d6aec7","MasterName":"Laptop Case",
    //         "CreatedAt":"2021-11-25 10:36:58","MasterType":"product","Name":"Laptop Case","Price":
    //         "6000","Code":"P5","Category":"Parts","Group":"product","ActiveStatus":"active"}],
    //         "Description":"DDDD","Amount":"6000","Status":"Service Accepted","CreatedBy":null,"CreatedAt":"2021-11-26 23:33:18","ModifiedBy":null,"ModifiedAt":"2021-11-26 23:33:18"}]
      // toastr('Mroduct Ad Modal Loading','success');
      return view('service.list', $data);
   } 
   public function ServiceAddModal(Request $request)
   { 
       
       $info['title']="Service [add/modify]";
       $info['size']=$request->get('size');
       $data=$request->get('param');
       $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
       $elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
 
       if (Session::has('loginid')) {
        $json_call_data=[ "MasterID"=>"all"];
        $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
        $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'product/read', $json_call_data)->json();
       if($response['status']){
            
            $elmData['product']= $response['data'] ; 
        }
        else{
            $elmData['product']=[]; 
        }

        $json_call_data=[ "UserID"=>"all"];
        $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
        $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'customer/read', $json_call_data)->json();
       if($response['status']){
            
            $elmData['customer']= $response['data'] ; 
        }
        else{ 
            $elmData['customer']=[];
        }



        $elmData['status']=[
            ["Status"=>"Received"],
            ["Status"=>"Processing"],
            ["Status"=>"Returned"],
            ["Status"=>"SendToCompany"],
            ["Status"=>"ReceivedFromCompany"],
            ["Status"=>"Delivered"],

        ];
    }
   
    // $elmData['ServiceID']='';
    // $elmData['Description']='';
    // $elmData['CustomerID']='';
    // $elmData['Amount']='0';

       $elmData['info']=$info;
       $GetView=view('service.addModal',$elmData)->render();
       return response()->json([
           "status" => true,
           "html" => $GetView
       ]);
   }
   


   public function ServiceStatus(Request $request)
   { 
       
       $info['title']="Service [status]";
       $info['size']=$request->get('size');
       $data=$request->get('param');
       $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
       $elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
 
       if (Session::has('loginid')) {
            $json_call_data=[ "MasterID"=>"all"];
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
            $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'product/read', $json_call_data)->json();
            if($response['status']){
                    
                    $elmData['product']= $response['data'] ; 
                }
                else{
                    $elmData['product']=[]; 
                }

            $json_call_data=[ "UserID"=>"all"];
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
            $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'customer/read', $json_call_data)->json();
            if($response['status']){
                    
                    $elmData['customer']= $response['data'] ; 
                }
                else{ 
                    $elmData['customer']=[];
                }
                $elmData['status']=[
                    ["Status"=>"Received"],
                    ["Status"=>"Processing"],
                    ["Status"=>"Returned"],
                    ["Status"=>"SendToCompany"],
                    ["Status"=>"ReceivedFromCompany"],
                    ["Status"=>"Delivered"],

                ];

        }
   
    // $elmData['ServiceID']='';
    // $elmData['Description']='';
    // $elmData['CustomerID']='';
    // $elmData['Amount']='0';

       $elmData['info']=$info;
       $GetView=view('service.status',$elmData)->render();
       return response()->json([
           "status" => true,
           "html" => $GetView
       ]);
   }
   


   public function saveService(Request $request)
   {
       $data=$request->all();
       $data = [
           "ServiceID" => is_null($request->ServiceID)? '':$request->ServiceID,
           "ProductID" => $request->ProductID,
           "ServiceDate" => date('Y-m-d H:i:s'),
           "CustomerID" => $request->CustomerID,
           "Description" => $request->Description,
           "Amount" => $request->Price ,
           "Status" =>$request->Status 
       ];
    //  dd($data);
       
     // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
      $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
      $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'service/create', $data);

       $res = $response->json();
       
       if ($res['status']) {
           toastr('Service update successfull','success');
          return $this->getServiceList();
           //return view('service.list');
           //return back()->with('success', 'You have registered successfully ');
       } else {
           toastr('Service update unsuccessfull','fail');
          return back()->with('fail', 'Something went wrong');
       }
      
   }

   public function ProductIncludeForServiceModal(Request $request)
   {

       $info['title'] = "Product [include-list]";
       $info['size'] = $request->get('size');
       $data = $request->get('param');
       $decrypt_data = openssl_decrypt($data, "AES-128-ECB", md5(env('ENC_SALT')));
       $elmData = (!empty($decrypt_data)) ? json_decode($decrypt_data, true) : array();

        $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
       $json_call_data = ["ServiceID" => $elmData['ServiceID']];
       $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'service/getIncludeProductDataForService', $json_call_data)->json();
       if ($response['status']) {

           $elmData['product_include'] = $response['data'];
       } else {
           $elmData['product_include'] = [];
       }

       $elmData['info'] = $info;
       $GetView = view('service.includeInServiceModal', $elmData)->render();
       return response()->json([
           "status" => true,
           "html" => $GetView,
       ]);
   }


   
   public function SaveIncludeProductForService(Request $request)
   {
       $data = $request->all();
       $data = [
           "ServiceID" => is_null($request->ServiceID) ? '' : $request->ServiceID,
           "SubProductID" => $request->SubProductID,
           "Description" => $request->Description,
       ];
 
       $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
      $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'service/setIncludeProductDataForService', $data)->json();
   
 
       if ($response['status']) {
        return $this->getServiceIncludeProduct($data['ServiceID']);
        // $json_call_data = ["ServiceID" => $data['ServiceID']];
        // $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
        // $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'service/getIncludeProductDataForService', $json_call_data)->json();
        // if ($response['status']) {

        //     $elmData['product_include'] = $response['data'];
        //     $GetView = view('service.includeInServiceModal', $elmData)->render();
        //     return response()->json([
        //         "status" => true,
        //         "html" => $GetView,
        //     ]);
        // } else {
        //     return response()->json([
        //         "status" => true,
        //         "html" =>"No Data Found",
        //     ]);
        // }
            // return response()->json([
            //     "status" => true,
            //     "html" => $data['ServiceID'].json_encode($response['data'],true) ,
            // ]);
      // return  $this->getServiceIncludeProduct($data['ServiceID']);
      
       } else {
           toastr('Product update unsuccessfull', 'fail');
           return back()->with('fail', 'Something went wrong');
       }
   
   }
   public function getServiceIncludeProduct($ServiceID){
    $json_call_data = ["ServiceID" => $ServiceID];
    $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
    $res = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'service/getIncludeProductDataForService', $json_call_data)->json();
    if ($res['status']) {

        $elmData['product_include'] = $res['data'];
        $elmData['ServiceID'] = $ServiceID;
       // $elmData=[];
        $GetView = view('service.includeList', $elmData)->render();
        return response()->json([
            "status" => true,
            "html" =>  $GetView,
        ]);
    } else {
        return response()->json([
            "status" => true,
            "html" =>"No Data Found",
        ]);
    }

}

}
