<?php

namespace App\Http\Controllers;
 
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Hash;
    
class EmployeeController extends Controller
{
         function getEmployeeList(Request $request){
       
            //return "Welcome!! to your Dashboard";
            
            //$data = array();
            $data['title']= "Employee";
            $data['name']= "Employee File";
             
          
            if (Session::has('loginid')) 
            { 
                $json_call_data=[ "UserID"=>'all']; 
                $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
                  $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'employee/read', $json_call_data)->json();
                 // dd($response);
                 //Session::put('user_data',$data['response'][0]);
                 if($response['status']){
                    $data['collection']=$response['data'];
                   // dd($response['data']);
                   $data['new']=["UserID"=>"","UserType"=>"employee","Code"=>"", "Name"=>"", "ContactNo"=>"", 
                   "Age"=>"", "Address"=>"", "Gender"=>"", "IsCollector"=>"", "Origin"=>"", "DOJ"=>""];
                  
                 }
                 else
                 {
                  $data['collection']=[];
                 $data['new']=["UserID"=>"","UserType"=>"employee","Code"=>"", "Name"=>"", "ContactNo"=>"", 
                 "Age"=>"", "Address"=>"", "Gender"=>"", "IsCollector"=>"", "Origin"=>"", "DOJ"=>""];
                // $this->employeeAddModal($request);
                 }
                 $data['service']=["ServiceID"=>"","ServiceDate"=>date('Y-m-d H:i:s'),
                 "EmployeeID"=>"","EmployeeData"=>[], "ProductID"=>"", "ProductData"=>[], "Description"=>"", "Amount"=>"", "Status"=>""];
                 return view('employee.list', $data);
                     //dd($data);
            }
           
       
        } 
        function EmployeeAddModal(Request $request)
        {
    
    
            $info['title']="Employee [add/modify]";
            $info['size']=$request->get('size');
            $data=$request->get('param');
            $decrypt_data 						= openssl_decrypt($data,"AES-128-ECB",md5(env('ENC_SALT')));	
            $elmData						= (!empty($decrypt_data))?json_decode($decrypt_data, true):array();
    //print_r($decrypt_data);
           
            $elmData['info']=$info;
            $GetView=view('employee.addModal',$elmData)->render();
            return response()->json([
                "status" => true,
                "html" => $GetView
            ]);
        }
        function saveEmployee(Request $request)
            {
                $data=$request->all();
                $data_json = [
                    "UserID" => is_null($request->UserID)? '':$request->UserID,
                    "UserType" => $request->UserType,
                    "Code" => $request->Code,
                    "Name" => $request->Name,
                    "ContactNo" => $request->ContactNo,
                    "Age" =>  $request->Age,
                    "Gender" =>  $request->Gender,
                    "Address" =>  $request->Address,
                    "DOJ" =>  $request->DOJ,
                    "IsCollector" =>  $request->IsCollector,
                    "Origin" =>  $request->Origin, 
                ];
            //  dd(json_encode($data));
                
              // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
               $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*",];
               $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'employee/create', $data_json);
        
                $res = $response->json();
                
                if ($res['status']) {
                    toastr('Employee update successfull','success');
                    return back()->with('success', 'You have registered successfully ');
                } else {
                    toastr('Employee update unsuccessfull','fail');
                    return back()->with('fail', 'Something went wrong');
                }
                //return $this->getEmployeeList($request);
              
            }
        
       
    
    }
