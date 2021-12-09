<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class CustomAuthController extends Controller
{
     
    public function login()
    { 
        
       
        if (Session::has('loginid')) {
            //dd(Session::has('loginid'));
            return redirect('/admin');
        }
       return view("auth.login");
    }
    
  
    public function registration()
    {

        return view("auth.registration");
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->$user->password);

        //$res = $user->save();
       
        $data = [
            "UserType" => "applicant",
            "FirstName" => $request->name,
            "LastName" => "Empty",
            "UserLoginID" =>  $request->email,
            "UserPass" => $request->password,
            "UserContactNo" =>  "1023456669",
            "UserEmail" =>  $request->email,
            "Qualification" =>  "string",
            "Percentage" =>  "85",
            "PassingYear" =>  "2000"
        ];
        //dd(json_encode($data,true));
        $response = Http::post(env('API_RESOURCE_URL').'/api/v1/pages/UserRegistration.php', $data);
        // dd($response->headers());
        $res = $response->json();
       // dd($res['status']);
        if ($res['status']) {
            return back()->with('success', 'You have registered successfully ');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
    public function loginUser(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'loginid' => 'required',
            'password' => 'required|min:5|max:12'
        ]);
      
        $data = [
            "UserName" =>  $request->loginid,
            "UserPassword" => $request->password 
        ];
       
       //  print_r(json_encode($data));
        $headers=["Accept" => "*"];//
      $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'users/login', $data)->json();
       // $response = Http::withHeaders($headers)->post('https://api.lifefertilitycentre.com/api/v1/pages/users/login', $data);
       // $response = Http::withHeaders($headers)->post('http://115.124.120.251:5052/api/v1/pages/UserLogin.php', $data);
        // $API_PATH =env('API_RESOURCE_URL') .'/users/login';
        // print_r($API_PATH);->json()
        //  $response = Http::withHeaders($headers)->post($API_PATH, $data);
      // dd($response);
         if($response['status']){
            // dd('HI');
           // $request->session()->put('_token',$response['id']['token']);
            Session::put('_token',$response['data']['token']);
            $token=$response['data']['token'];
            Session::put('loginid',$response['data']['UserID']);
            $request->headers->set('Authorization',"Bearer ".$token);
           // $request->createToken($token);
         //   dd($request->session()->get('loginid'));
           $json_call_data=[ "ID"=>$response['data']['UserID'] ];
        
       // $headers=["Authorization" => "Bearer ".$request->session()->get('_token'),"Accept" => "*"];
           //  $userdata=Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'/api/v1/pages/GetUserDetailsByID.php', $json_call_data)->json();
            // dd($request->header());
            // dd($userdata);
           // dd($request->session()->get('loginid'));
            //  return $this->adminDashboard($request);
            return redirect('/admin');
            // dd($response['id']);
         }
    }
     public function dashboard(Request $request)
    {
        //return "Welcome!! to your Dashboard";
       // dd($request->session()->get('_token'));
        $data = array();
        if (Session::has('loginid')) {
            $json_call_data=[ "ID"=>Session::get('loginid')];
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*"];
            $data = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'users/read', $json_call_data)->json();
            Session::put('user_data',$data['data']);
        }
      
        $data=$data['data'];

       return view('/admin', $data);
    } 
    public function adminDashboard(Request $request)
    {
        //return "Welcome!! to your Dashboard";
       // dd($request->session()->get('_token'));
        $data = array();
        if (Session::has('loginid')) {
            $json_call_data=[ "UserID"=>Session::get('loginid')];
          
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*"];
           // dd($headers);
            $data = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'users/read', $json_call_data)->json();
             
            Session::put('user_data',$data['data'][0]);
           
            $data=$data['data'][0];
        }
       
        //dd($data);

       return view('admin.dashboard', $data);
    } 
  
    public function servicingsession(Request $request)
    {
        //return "Welcome!! to your Dashboard";
       // dd($request->session()->get('_token'));
        //$data = array();
        $data['title']= "Service";
        $data['name']= "Service list";
         
      
        if (Session::has('loginid')) {
            $json_call_data=[ "ID"=>Session::get('loginid')];
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*"];
             //$res = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'/api/v1/pages/ListOfSessions.php', $json_call_data)->json();
             //Session::put('user_data',$data['response'][0]);
             //$data['collection']=$res['response'][0];
             $data['collection']=[
                ["ServiceDate"=>date('d-m-Y'), "ServicingID"=>"S1", "Contacts"=>"9800012540", "Description"=>"CPU Repairing", "Status"=>"Done"],
                ["ServiceDate"=>date('Y-m-d'), "ServicingID"=>"S2", "Contacts"=>"1234568795", "Description"=>"Monitor Repairing", "Status"=>"Undone"],
                ["ServiceDate"=>date('Y-m-d'), "ServicingID"=>"S3", "Contacts"=>"9874562513", "Description"=>"Hardware Buyer", "Status"=>"Done"],
                ["ServiceDate"=>date('Y-m-d'), "ServicingID"=>"S5", "Contacts"=>"2548733487", "Description"=>"Motherboard Repairing", "Status"=>"Done"],
                ["ServiceDate"=>date('Y-m-d'), "ServicingID"=>"S6", "Contacts"=>"9830014587", "Description"=>"Computer System Buyer", "Status"=>"Undone"],
            ];
        }
       
        

       return view('servicingsession', $data);
    } 
    public function serviceinfo(Request $request)
    {   
        $data['title']="New Service";
        $data['id']="Service_Id";
        $data['collection']="Add Service Details";
        return view('service',$data);
      

    }
    public function addcustomer()
    {
        $data['title']="Add Customer";
        $data['name']="Add Customer";
        $data['collection']="Add Customer";
        return view('addcustomer',$data);
    }
    public function save(Request $request)
    {
        //$input = $request->all(); 
       // dd($request->all());
        //$customername = $request->input('customer_name');
        //$contacts= $request->input('contact_no');
        //$customeraddress = $request->input('address');
        //$customerdescription = $request->input('description');
        
        $request->validate([
            'customer_name' => 'required',
            'contacts' => 'required|min:10|max:10',
        ]);
        $data = [
            "UserName" => $request->customer_name,
            "UserContact" => $request->contact_no,
            "Useraddress" => $request->address,
            "Userdescription" => $request->description,
            "DeviceType" =>  $request->header('User-Agent'),
            "PushID" =>   "vjgggihiuihi",
        ];
      // DB::insert('insert into customer_detail(customer_name, contact_no, address, description) values(?,?,?,?)',
      //   [$customer_name , $contact_no , $address , $description]);
      //   return redirect('customer')->with ('success' , 'Data Saved')
         $headers=["Accept" => "*"];
         $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'/api/v1/pages/addcustomer.php', $data)->json();

         if($response['status']){
            // dd('HI');
           // $request->session()->put('_token',$response['id']['token']);
            Session::put('_token',$response['id']['token']);
            $token=$response['id']['token'];
            Session::put('loginid',$response['id']['UserID']);
            $request->headers->set('Authorization',"Bearer ".$token);
           // $request->createToken($token);
         //   dd($request->session()->get('loginid'));
           $json_call_data=[
            "ID"=>$response['id']['UserID']
        ];
        
       // $headers=["Authorization" => "Bearer ".$request->session()->get('_token'),"Accept" => "*",];
           //  $userdata=Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'/api/v1/pages/GetUserDetailsByID.php', $json_call_data)->json();
            // dd($request->header());
            // dd($userdata);
           // dd($request->session()->get('loginid'));
            // return redirect('/admin');
            // dd($response['id']);
       }
    }

    public function customerlist(Request $request)
    {
        //return "Welcome!! to your Dashboard";
       // dd($request->session()->get('_token'));
        //$data = array();
        $data['title']= "Service";
        $data['name']= "Service list";
         
      
        if (Session::has('loginid')) {
            $json_call_data=[ "ID"=>Session::get('loginid')];
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*"];
             //$res = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'/api/v1/pages/ListOfSessions.php', $json_call_data)->json();
             //Session::put('user_data',$data['response'][0]);
             //$data['collection']=$res['response'][0];
             $data['collection']=[
                ["EntryDate"=>date('d-m-Y'), "CustomerID"=>"C1", "Contacts"=>"9800012540", "Address"=>"Kolkata", "Description"=>"CPU Repairing"],
                ["EntryDate"=>date('Y-m-d'), "CustomerID"=>"C2", "Contacts"=>"1234568795", "Address"=>"Baguaiti", "Description"=>"Monitor Repairing"],
                ["EntryDate"=>date('Y-m-d'), "CustomerID"=>"C3", "Contacts"=>"9874562513", "Address"=>"Gariahat", "Description"=>"Hardware Buyer"],
                ["EntryDate"=>date('Y-m-d'), "CustomerID"=>"C4", "Contacts"=>"2548733487", "Address"=>"Barasat", "Description"=>"Motherboard Repairing"],
                ["EntryDate"=>date('Y-m-d'), "CustomerID"=>"C5", "Contacts"=>"9830014587", "Address"=>"Baruipur", "Description"=>"Computer System Buyer"],
            ];
        }
       
        

       return view('customerlist', $data);
    } 
    public function eventsession(Request $request)
    {
        //return "Welcome!! to your Dashboard";
       // dd($request->session()->get('_token'));
        //$data = array();
        $data['title']= "Event Session";
        $data['name']= "Event list";
           
      
        if (Session::has('loginid')) {
            $json_call_data=[ "ID"=>Session::get('loginid')];
            $headers=["Authorization" => "Bearer ".Session::get('_token'),"Accept" => "*"];
             $res = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') .'/api/v1/pages/ListOfSessions.php', $json_call_data)->json();
             //Session::put('user_data',$data['response'][0]);
             $data['collection']=$res['response'];
           // dd($data);
          
        }
       return view('eventsession', $data);
    } 
    public function logout()
    {
         
        Session::flush();
        
        Auth::logout();
        
       return Redirect::back()->with('message','Operation Successful !');
       
    }
}