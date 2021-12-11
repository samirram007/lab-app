<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController as CC;
use App\Http\Controllers\ServiceController as SC;
use App\Http\Controllers\CustomerController as CU;
use App\Http\Controllers\PatientController as PU;
use App\Http\Controllers\ProductController as PC;
use App\Http\Controllers\EmployeeController as EC;
use App\Http\Controllers\Ref_doctorController as RC;
use App\Http\Controllers\AgencyController as AC;
use App\Http\Controllers\Outdoor_DoctorController as OC;
use App\Http\Controllers\Reporting_DoctorController as RU;

 


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

        Route::get('/patient', [PU:: class, 'getPatientList'])->name('patient-list');
        Route::get('/addpatient',[PU::class, 'PatientAddModal'])->name('addpatient');
        Route::post('/patient-save',[PU::class, 'savePatient'])->name('save-patient');

        Route::get('/agency', [AC:: class, 'getAgencyList'])->name('agency-list');
        Route::get('/addagency',[AC::class, 'AgencyAddModal'])->name('addagency');
        Route::post('/agency-save',[AC::class, 'saveAgency'])->name('save-agency');

        Route::get('/employee', [EC:: class, 'getEmployeeList'])->name('employee-list');
        Route::get('/addemployee',[EC::class, 'EmployeeAddModal'])->name('addemployee');
        Route::post('/employee-save',[EC::class, 'saveEmployee'])->name('save-employee');

        Route::get('/outdoor_doctor', [OC:: class, 'getOutdoor_doctorList'])->name('outdoor_doctor-list');
        Route::get('/addoutdoor_doctor',[OC::class, 'Outdoor_doctorAddModal'])->name('addoutdoor_doctor');
        Route::post('/outdoor_doctor-save',[OC::class, 'saveOutdoor_doctor'])->name('save-outdoor_doctor');

        Route::get('/ref_doctor', [RC:: class, 'getRef_doctorList'])->name('ref_doctor-list');
        Route::get('/addref_doctor',[RC::class, 'Ref_doctorAddModal'])->name('addref_doctor');
        Route::post('/ref_doctor-save',[RC::class, 'saveRef_doctor'])->name('save-ref_doctor');

        Route::get('/reporting_doctor', [RU:: class, 'getReporting_doctorList'])->name('/reporting_doctor-list');
        Route::get('/addreporting_doctor',[RU::class, 'Reporting_doctorAddModal'])->name('addreporting_doctor');
        Route::post('/reporting_doctor-save',[RU::class, 'saveReporting_doctor'])->name('save-reporting_doctor');


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
