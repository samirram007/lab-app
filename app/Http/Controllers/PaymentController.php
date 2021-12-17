<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
     function getPaymentList(Request $request){

        $data['title']= "Payment";
        $data['name']= "Payment list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'payment/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"payment","Code"=>"", "BookingID"=>"", "PaymentNo"=>"",
                "PaymentID"=>"", "Amount"=>"", "PaymentMode"=>"", 
                "TransactionNo"=>"", "PaymentDate"=>"",  "Origin"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"payment","Code"=>"", "BookingID"=>"",
              "PaymentNo"=>"", "PaymentID"=>"", "Amount"=>"", 
              "PaymentMode"=>"", "TransactionNo"=>"", "PaymentDate"=>"", "Origin"=>""];
            // $this->PaymentAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "PaymentID"=>"","PaymentData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('payment.list', $data);
                 //dd($data);
        }
       
   
    } 
    function PaymentAddModal(Request $request)
    {


        $info['title']="Payment [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('payment.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function savePayment(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "BookingID" => $request->BookingID,
                "PaymentNo" => $request->PaymentNo,
                "PaymentID" => $request->PaymentID,
                "Amount" => $request->Amount,
                "PaymentMode" => $request->PaymentMode,
                "TransactionNo" => $request->TransactionNo,
                "PaymentDate" => $request->PaymentDate,
                "Origin" => $request->Origin,
                                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'payment/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Payment update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Payment update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getPaymentList($request);
          
        }
    
   

}