<?php

namespace App\Http\Controllers;
 
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Hash;
    
class AgencyController extends Controller
{

         function getAgencyList(Request $request){
       
            //return "Welcome!! to your Dashboard";
            
            //$data = array();
            $data['title']= "Agency";
            $data['name']= "Agency File";
            
          
            if (Session::has('loginid')) 
            { 
                $json_call_data=[ "UserID"=>'all']; 
                $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
                  $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'agency/read', $json_call_data)->json();
                 // dd($response);
                 //Session::put('user_data',$data['response'][0]);
                 if($response['status']){
                    $data['collection']=$response['data'];
                   // dd($response['data']);
                   $data['new']=["UserID"=>"","UserType"=>"agency","Code"=>"", "Name"=>"", "ContactNo"=>"", "CommissionDept"=>"", "Address"=>"", "Origin"=>""];
                  
                 }
                 else
                 {
                  $data['collection']=[];
                 $data['new']=["UserID"=>"","UserType"=>"agency","Code"=>"", "Name"=>"", "ContactNo"=>"", "CommissionDept"=>"", "Address"=>"", "Origin"=>""];
                // $this->agencyAddModal($request);
                 }
                 $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
                 "AgencyID"=>"","AgencyData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
                 return view('agency.list', $data);
                     //dd($data);
            }
           
       
        } 
        function AgencyAddModal(Request $request)
        {
    
    
            $info['title']="Agency [add/modify]";
            $info['size']=$request->get('size');
            $data=$request->get('param');
            $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
            $elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
    //print_r($decrypt_data);
           
            $elmData['info']=$info;
            $GetView=view('agency.addModal',$elmData)->render();
            return response()->json([
                "status" => true,
                "html" => $GetView
            ]);
        }
        function saveAgency(Request $request)
            {
                $data=$request->all();
                $data_json = [
                    "UserID" => is_null($request->UserID)? '':$request->UserID,
                    "UserType" => $request->UserType,
                    "Code" => $request->Code,
                    "Name" => $request->Name,
                    "ContactNo" => $request->ContactNo,
                    "CommissionDept" =>  $request->CommissionDept,                    
                    "Address" =>  $request->Address,
                    "Origin" =>  $request->Origin, 
                ];
            //  dd(json_encode($data));
                
              // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
               $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
               $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'agency/create', $data_json);
        
                $res = $response->json();
                
                if ($res['status']) {
                    toastr('Agency update successfull','success');
                    return back()->with('success', 'You have registered successfully ');
                } else {
                    toastr('Agency update unsuccessfull','fail');
                    return back()->with('fail', 'Something went wrong');
                }
                //return $this->getAgencyList($request);
              
            }
        
       
    
    }
