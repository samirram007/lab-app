<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class DraftController extends Controller
{
     function getDraftList(Request $request){

        $data['title']= "Draft";
        $data['name']= "Draft list";
         
      
        if (Session::has('loginid')) 
        { 
            $json_call_data=[ "MasterID"=>'all']; 
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
              $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'draft/read', $json_call_data)->json();
             // dd($response);
             //Session::put('user_data',$data['response'][0]);
             if($response['status']){
                $data['collection']=$response['data'];
               // dd($response['data']);
               $data['new']=["MasterID"=>"","MasterType"=>"draft","Code"=>"", "DraftID"=>"", "DraftNo"=>"",
                "DraftGroupID"=>"", "DraftData"=>"", "Origin"=>"", "DraftDate"=>"", "DraftEndDate"=>""];
              
             }
             else
             {
              $data['collection']=[];
             $data['new']=["MasterID"=>"","MasterType"=>"draft","Code"=>"", "DraftID"=>"",
              "DraftNo"=>"", "DraftData"=>"", "Origin"=>"", "DraftDate"=>"", "DraftEndDate"=>""];
            // $this->DraftAddModal($request);
             }
             $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
             "DraftID"=>"","DraftData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
             return view('draft.list', $data);
                 //dd($data);
        }
       
   
    } 
    function DraftAddModal(Request $request)
    {


        $info['title']="Draft [add/modify]";
        $info['size']=$request->get('size');
        $data=$request->get('param');
        $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
		$elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
//print_r($decrypt_data);
       
        $elmData['info']=$info;
        $GetView=view('draft.addModal',$elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView
        ]);
    }
    function saveDraft(Request $request)
        {
            $data=$request->all();
            $data_json = [
                "MasterID" => is_null($request->MasterID)? '':$request->MasterID,
                "MasterType" => $request->MasterType,
                "Code" => $request->Code,            
                "DraftID" => $request->DraftID,
                "DraftNo" => $request->DraftNo,
                "DraftData" => $request->DraftData,
                "Origin" => $request->Origin,
                "DraftDate" => $request->DraftDate,
                "DraftEndDate" => $request->DraftEndDate,
                                
            ];
        //  dd(json_encode($data));
            
          // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
           $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
           $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'draft/create', $data_json);
    
            $res = $response->json();
            
            if ($res['status']) {
                toastr('Draft update successfull','success');
                return back()->with('success', 'You have registered successfully ');
            } else {
                toastr('Draft update unsuccessfull','fail');
                return back()->with('fail', 'Something went wrong');
            }
            //return $this->getDraftList($request);
          
        }
    
   

}