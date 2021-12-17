<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
     function getBookingList(Request $request){

        $data['title']= "Booking";
        $data['name']= "Booking list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'booking/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"booking","Code"=>"", "RefDoctorID"=>"", "BookingNo"=>"",
                "BookingID"=>"", "PatientID"=>"", "AgencyID"=>"", 
                "Origin"=>"", "BookingDate"=>"", "CreatedAt"=>"", "ModifiedAt"=>"", "CreatedBy"=>"", "ModifiedBy"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"booking","Code"=>"", "RefDoctorID"=>"",
              "BookingNo"=>"", "BookingID"=>"", "PatientID"=>"", 
              "AgencyID"=>"", "Origin"=>"", "BookingDate"=>"", 
              "CreatedAt"=>"", "ModifiedAt"=>"", "CreatedBy"=>"", "ModifiedBy"=>""];
            // $this->BookingAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "BookingID"=>"","BookingData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('booking.list', $data);
                 //dd($data);
        }
       
   
    } 
    function BookingAddModal(Request $request)
    {


        $info['title']="Booking [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('booking.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveBooking(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,
                "RefDoctorID" => $request->RefDoctorID,
                "BookingNo" => $request->BookingNo,
                "BookingID" => $request->BookingID,
                "PatientID" => $request->PatientID,
                "AgencyID" => $request->AgencyID,
                "Origin" => $request->Origin,
                "BookingDate" => $request->BookingDate,
                "CreatedAt" => $request->CreatedAt,  
                "ModifiedAt" => $request->ModifiedAt,
                "CreatedBy" => $request->CreatedBy,
                "ModifiedBy" => $request->ModifiedBy,
                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'booking/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Booking update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Booking update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getBookingList($request);
          
        }
    
   

}