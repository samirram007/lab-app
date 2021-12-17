<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class BookingDetailsController extends Controller
{
     function getBookingDetailsList(Request $request){

        $data['title']= "BookingDetails";
        $data['name']= "BookingDetails list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'bookingdetails/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"bookingdetails","Code"=>"", "TestDate"=>"", "BookingDetailsID"=>"",
                "BookingID"=>"", "ReportDate"=>"", "TestPackageID"=>"", 
                "TestID"=>"", "UnitValue"=>"", "Quantity"=>"", "Discount"=>"", "Amount"=>"", "Status"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"bookingdetails","Code"=>"", "TestDate"=>"",
              "BookingDetailsID"=>"", "BookingID"=>"", "ReportDate"=>"", 
              "TestPackageID"=>"", "TestID"=>"", "UnitValue"=>"", 
              "Quantity"=>"", "Discount"=>"", "Amount"=>"", "Status"=>""];
            // $this->BookingDetailsAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "BookingDetailsID"=>"","BookingDetailsData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('bookingdetails.list', $data);
                 //dd($data);
        }
       
   
    } 
    function BookingDetailsAddModal(Request $request)
    {


        $info['title']="BookingDetails [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('bookingdetails.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveBookingDetails(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "TestDate" => $request->TestDate,
                "BookingDetailsID" => $request->BookingDetailsID,
                "BookingID" => $request->BookingID,
                "ReportDate" => $request->ReportDate,
                "TestPackageID" => $request->TestPackageID,
                "TestID" => $request->TestID,
                "UnitValue" => $request->UnitValue,
                "Quantity" => $request->Quantity,  
                "Discount" => $request->Discount,
                "Amount" => $request->Amount,
                "Status" => $request->Status,
                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'bookingdetails/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('BookingDetails update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('BookingDetails update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getBookingDetailsList($request);
          
        }
    
   

}