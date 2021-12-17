<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class CancellationController extends Controller
{
     function getCancellationList(Request $request){

        $data['title']= "Cancellation";
        $data['name']= "Cancellation list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'cancellation/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"cancellation","Code"=>"", "BookingID"=>"", "CancellationNo"=>"",
                "CancellationID"=>"", "Amount"=>"", "ReturnReason"=>"", 
                "TestID"=>"", "CancellationDate"=>"",  "Origin"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"cancellation","Code"=>"", "BookingID"=>"",
              "CancellationNo"=>"", "CancellationID"=>"", "Amount"=>"", 
              "ReturnReason"=>"", "TestID"=>"", "CancellationDate"=>"", "Origin"=>""];
            // $this->CancellationAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "CancellationID"=>"","CancellationData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('cancellation.list', $data);
                 //dd($data);
        }
       
   
    } 
    function CancellationAddModal(Request $request)
    {


        $info['title']="Cancellation [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('cancellation.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveCancellation(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "BookingID" => $request->BookingID,
                "CancellationNo" => $request->CancellationNo,
                "CancellationID" => $request->CancellationID,
                "Amount" => $request->Amount,
                "ReturnReason" => $request->ReturnReason,
                "TestID" => $request->TestID,
                "CancellationDate" => $request->CancellationDate,
                "Origin" => $request->Origin,
                                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'cancellation/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Cancellation update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Cancellation update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getCancellationList($request);
          
        }
    
   

}