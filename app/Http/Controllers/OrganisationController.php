<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class OrganisationController extends Controller
{
     function getOrganisationList(Request $request){

        $data['title']= "Organisation";
        $data['name']= "Organisation list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'org/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"organisation","Code"=>"", "Name"=>"", "ContactNo1"=>"",
                "ContactNo2"=>"", "Address"=>"", "Email"=>"", "DateofFoundation"=>"", "CELicenseNo"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"organisation","Code"=>"", "Name"=>"",
              "ContactNo1"=>"", "ContactNo2"=>"", "Address"=>"", "Email"=>"", "DateofFoundation"=>"", "CELicenseNo"=>""];
            // $this->OrganisationAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "OrganisationID"=>"","OrganisationData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('organisation.list', $data);
                 //dd($data);
        }
       
   
    } 
    function OrganisationAddModal(Request $request)
    {


        $info['title']="Organisation [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('organisation.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveOrganisation(Request $request)
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
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'org/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Organisation update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Organisation update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getOrganisationList($request);
          
        }
    
   

}