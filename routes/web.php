<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController as CC;
use App\Http\Controllers\ServiceController as SC;
use App\Http\Controllers\CustomerController as CU;
use App\Http\Controllers\PatientController as PU;
use App\Http\Controllers\ProductController as PC;
 

// Route::get('/welcome', function () {
//     return view('welcome');
// });


Route::get('/registration', [CC::class, 'registration']);
Route::post('/register-user', [CC::class, 'registerUser'])->name('register-user');



Route::group(['middleware'=>'preventbackhistory'],function(){
    Route::group(['middleware'=>'isNotLoggedIn'],function(){
        Route::get('/login', [CC::class, 'login']);
        Route::post('/login-user', [CC::class, 'loginUser'])->name('login-user');
     }); 

    Route::group(['middleware'=>'isLoggedIn'],function(){
         
        // Route::get('/', [CC::class, 'adminDashboard']);
        Route::get('/', [CU:: class, 'getCustomerList'])->name('customer-list');
        // Route::get('/dashboard', [CC::class, 'dashboard']);
        Route::get('/dashboard', [CU:: class, 'getCustomerList'])->name('customer-list');
        Route::get('/admin',[CC::class, 'adminDashboard']);
        // Route::get('/admin', [CU:: class, 'getCustomerList'])->name('customer-list');
        
        // Route::get('/eventsession-page',[CC::class, 'eventsession'])->name('eventsession-page');
        // Route::get('/eventhistory-page',[CC::class, 'eventhistory'])->name('eventhistory-page');

        Route::get('/product',[PC::class, 'getProductList'])->name('product-list');
        Route::get('/addproduct',[PC::class, 'ProductAddModal'])->name('addproduct');
        Route::get('/includeproduct',[PC::class, 'ProductIncludeModal'])->name('includeproduct');
        Route::get('/save_includeproduct',[PC::class, 'SaveIncludeProduct'])->name('save_includeproduct');
        Route::post('/product-save',[PC::class, 'saveProduct'])->name('save-product'); 

        Route::get('/customer', [CU:: class, 'getCustomerList'])->name('customer-list');
        Route::get('/addcustomer',[CU::class, 'CustomerAddModal'])->name('addcustomer');
        Route::post('/customer-save',[CU::class, 'saveCustomer'])->name('save-customer');

        Route::get('/patient', [CU:: class, 'getPatientList'])->name('patient-list');
        Route::get('/addpatient',[CU::class, 'PatientAddModal'])->name('addpatient');
        Route::post('/patient-save',[CU::class, 'savePatient'])->name('save-patient');

        Route::get('/service',[SC::class, 'getServiceList'])->name('service-list');
        Route::get('/addService',[SC::class, 'ServiceAddModal'])->name('addservice');

        Route::get('/servicestatus',[SC::class, 'ServiceStatus'])->name('changestatus');
        Route::get('/product_include_in_service',[SC::class, 'ProductIncludeForServiceModal'])->name('product_include_in_service');
        
        Route::get('/save_product_include_in_service',[SC::class, 'SaveIncludeProductForService'])->name('save_product_include_in_service');
        //Route::resource('servicingsession', 'CustomAuthController');
        Route::post('/service-save',[SC::class, 'saveService'])->name('save-service');


        
        
        // Route::get('/service-page', [CC:: class, 'serviceinfo'])->name('service-page');

});
});


Route::get('/logout', [CC::class, 'logout']);
 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
