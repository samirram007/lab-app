<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function getProductList(Request $request)
    {

        $data['info'] = [
            "title" => "Product",
            "name" => "Product list",
        ];

        if (Session::has('loginid')) {
            $json_call_data = ["MasterID" => "all"];
            $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
            $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'product/read', $json_call_data)->json();

            if ($response['status']) {
                $data['collection'] = $response['data'];
                $data['new'] = ["MasterID" => "", "MasterType" => "product", "Code" => "", "Name" => "", "Price" => "", "Category" => ""];
            }
            $data['new'] = ["MasterID" => "", "MasterType" => "product", "Code" => "", "Name" => "", "Price" => "", "Category" => ""];
            // dd($data);
        }

        // toastr('Mroduct Ad Modal Loading','success');
        return view('product.list', $data);
    }
    public function ProductAddModal(Request $request)
    {

        $info['title'] = "Product [add/modify]";
        $info['size'] = $request->get('size');
        $data = $request->get('param');
        $decrypt_data = openssl_decrypt($data, "AES-128-ECB", md5(env('ENC_SALT')));
        $elmData = (!empty($decrypt_data)) ? json_decode($decrypt_data, true) : array();
       // dd($elmData);
        $elmData['info'] = $info;
        $GetView = view('product.addModal', $elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView,
        ]);
    }

    public function saveProduct(Request $request)
    {
        $data = $request->all();
        $data = [
            "MasterID" => is_null($request->MasterID) ? '' : $request->MasterID,
            "MasterType" => $request->MasterType,
            "Code" => $request->Code,
            "Name" => $request->Name,
            "Price" => $request->Price,
            "Category" => $request->Category,
        ];
        //dd($data);

        // $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
        $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
        $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'product/create', $data);

        $res = $response->json();

        if ($res['status']) {
            toastr('Product update successfull', 'success');
            return back()->with('success', 'You have registered successfully ');
        } else {
            toastr('Product update unsuccessfull', 'fail');
            return back()->with('fail', 'Something went wrong');
        }
        //return $this->getProductList($request);
        //["ProductID"=>"P1", "ProductName"=>"Computer", "Price"=>"50000", "Category"=>"Accessories"],
        //  dd($data);

        // return $this->product($request);
        //  return view('product-page', $data);
        // return route("/product");
        // return $data;
    }


    public function ProductIncludeModal(Request $request)
    {

        $info['title'] = "Product [include-list]";
        $info['size'] = $request->get('size');
        $data = $request->get('param');
        $decrypt_data = openssl_decrypt($data, "AES-128-ECB", md5(env('ENC_SALT')));
        $elmData = (!empty($decrypt_data)) ? json_decode($decrypt_data, true) : array();
     
        $json_call_data = ["MasterID" => "all"];
        $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
        $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'product/read', $json_call_data)->json();
        if ($response['status']) {
            $elmData['product'] = $response['data'];
        } else {
            $elmData['product'] = [];
        }

        $json_call_data = ["ProductID" => $elmData['MasterID']];
        $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'product/getIncludeProductData', $json_call_data)->json();
        if ($response['status']) {

            $elmData['product_include'] = $response['data'];
        } else {
            $elmData['product_include'] = [];
        }

        $elmData['info'] = $info;
        $GetView = view('product.includeModal', $elmData)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView,
        ]);
    }
 
    public function SaveIncludeProduct(Request $request)
    {
        $data = $request->all();
        $data = [
            "ProductID" => is_null($request->MasterID) ? '' : $request->MasterID,
            "SubProductID" => $request->IncludeProductID,
        ];
       

      //  $response = Http::post(env('API_RESOURCE_URL').'product/create', $data);
        $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
        $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'product/setIncludeProductData', $data)->json();
 
        if ($response['status']) {
            toastr('Product update successfull', 'success');
            return $this->getIncludeProduct($data['ProductID']);//"{\"list\":\"success\"}";
         // return "Successfull";// $this-> ProductIncludeModal($request);
           // return back()->with('success', 'You have registered successfully ');
        } else {
            toastr('Product update unsuccessfull', 'fail');
            return back()->with('fail', 'Something went wrong');
        }
    
    }
    public function getIncludeProduct($ProductID){
        $json_call_data = ["ProductID" => $ProductID];
        $headers = ["Authorization" => "Bearer " . Session::get('_token'), "Accept" => "application/json"];
        $response = Http::withHeaders($headers)->post(env('API_RESOURCE_URL') . 'product/getIncludeProductData', $json_call_data)->json();
        if ($response['status']) {

            $elmData['product_include'] = $response['data'];
            $GetView = view('product.includeList', $elmData)->render();
            return response()->json([
                "status" => true,
                "html" => $GetView,
            ]);
        } else {
            return response()->json([
                "status" => true,
                "html" =>"No Data Found",
            ]);
        }

    }
}