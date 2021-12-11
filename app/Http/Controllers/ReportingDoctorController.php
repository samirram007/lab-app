<?php

namespace App\Http\Controllers;
 
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Hash;
    
class ReportingdoctorController extends Controller
{
         function getReportingdoctorList(Request $request){
       
            //return "Welcome!! to your Dashboard";
            
            //$data = array();
            $data['title']= "Reportingdoctor";
            $data['name']= "Reportingdoctor File";
             
          
            if (Session::has('loginid')) 
            { 
                $json_call_data=[ "UserID"=>'all']; 
                $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
                  $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'reportingdoctor/read', $json_call_data)->json();
                 // dd($response);
                 //Session::put('user_data',$data['response'][0]);
                 if($response['status']){
                    $data['collection']=$response['data'];
                   // dd($response['data']);
                   $data['new']=["UserID"=>"","UserType"=>"reportingdoctor","Code"=>"", "Name"=>"", 
                   "ContactNo"=>"", "DoctorType"=>"", "Degree"=>"", "RegistrationNo"=>"", "Salary"=>""  ];
                  
                 }
                 else
                 {
                  $data['collection']=[];
                 $data['new']=["UserID"=>"","UserType"=>"reportingdoctor","Code"=>"", "Name"=>"", 
                 "ContactNo"=>"", "DoctorType"=>"", "Degree"=>"", "RegistrationNo"=>"","Salary"=>""  ];
                // $this->reportingdoctorAddModal($request);
                 }
                 $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
                 "ReportingdoctorID"=>"","ReportingdoctorData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
                 return view('reportingdoctor.list', $data);
                     //dd($data);
            }
           
       
        } 
        function ReportingdoctorAddModal(Request $request)
        {
    
    
            $info['title']="Reportingdoctor [add/modify]";
            $info['size']=$request->get('size');
            $data=$request->get('param');
            $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
            $elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
    //print_r($decrypt_data);
           
            $elmData['info']=$info;
            $GetView=view('reportingdoctor.addModal',$elmData)->render();
            return response()->json([
                "status" => true,
                "html" => $GetView
            ]);
        }
        function saveReportingdoctor(Request $request)
            {
                $data=$request->all();
                $data_json = [
                    "UserID" => is_null($request->UserID)? '':$request->UserID,
                    "UserType" => $request->UserType,
                    "Code" => $request->Code,
                    "Name" => $request->Name,
                    "ContactNo" => $request->ContactNo,
                    "DoctorType" =>  $request->DoctorType, 
                    "Degree" =>  $request->Degree, 
                    "RegistrationNo" =>  $request->RegistrationNo, 
                    "Salary" =>  $request->Salary, 
                ];
            //  dd(json_encode($data));
                
              // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
               $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "application/json",];
               $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'reportingdoctor/create', $data_json);
        
                $res = $response->json();
                
                if ($res['status']) {
                    toastr('Reportingdoctor update successfull','success');
                    return back()->with('success', 'You have registered successfully ');
                } else {
                    toastr('Reportingdoctor update unsuccessfull','fail');
                    return back()->with('fail', 'Something went wrong');
                }
                //return $this->getReportingdoctorList($request);
              
            }
        
       
    
    }
