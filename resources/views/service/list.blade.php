@extends('admin.master')

@section('content')


  
   
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $info['title'] }} </h1>
             
                
             
             
          </div><!-- /.col -->
          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              {{-- <!--li class="breadcrumb"><a class="btn btn-primary mx-2" href="{{ route('product-page')}}"><i class="fas fa-plus mx-1"></i>New</a></li--> --}}
              <li class="breadcrumb">
                
                {{-- <!--a   href ="{{ route('addproduct') }}"  class="btn btn-primary mx-2" data-toggle="modal" data-target="#modalAddProduct"--> --}}
                  
            </li>
               
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $info['name'] }}</li> 
              
            </ol>
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                      <a href="javascript:;" data-real="{{ $new['ServiceID'] }}" 
                  data-param="{{openssl_encrypt(json_encode($new),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
                  data-url="{{ route('addservice') }}" data-size="md" title="Edit Area" class="load-popup btn btn-primary mx-2  "> 
              <i class="fas fa-plus mx-1"></i>New</a>
                      {{-- <h3 class="card-title">Service item with default features</h3> --}}
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table">
                        <thead>
                        <tr>
                          <th>Service Description</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)
                             
                            <tr>
                              {{-- <td>{{ substr( $item['ServiceID'], -5)}}</td> --}}
                              <td>


                                <div class="card mb-3">
                                  <h5 class="card-header bg-light">
                                    <div>Service No. :  {{ $item['ServiceNo']}}
                                    
                                      <a href="javascript:;" data-real="{{ $item['ServiceID'] }}" 
                                      data-param="{{openssl_encrypt(json_encode($item),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
                                      data-url="{{ route('addservice') }}" data-size="md" title="Edit Area"
                                       class="load-popup text-light edit-btn btn btn-info btn-circle ">
                                      <i class="fas fa-pencil-alt"></i></a>
                                    
                                    </div>
                                    <div class="h6">Date : {{ \Carbon\Carbon::parse($item['ServiceDate'])->format('d-m-Y')  }}</div>
                                  </h5>
                                  

                                  <div class="card-body">
                                    <h6 class="card-title">
                                      <div class="h6">
                                      Customer : 
                                       @foreach($item['CustomerData'] as $Customer)
                                          {{   $Customer['Name'] }}
                                        @endforeach
                                      </div>
                                      <div class="h6">
                                        Contact : 
                                         @foreach($item['CustomerData'] as $Customer)
                                            {{   $Customer['ContactNo'] }}
                                          @endforeach
                                        </div>

                                    </h6>
                                    <p class="card-text">
                                      <div>
                                        Product :
                                        @foreach($item['ProductData'] as $Product)
                                          {{   $Product['Name'] }}
                                        @endforeach 
                                        <a href="javascript:;" data-real="{{ $item['ServiceID'] }}" 
                                        data-param="{{openssl_encrypt(json_encode($item),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
                                        data-url="{{ route('product_include_in_service') }}" data-size="lg" title="Edit Area" 
                                        class="load-popup text-white ml-2 edit-btn btn btn-primary btn-circle">
                                        <i class="fas fa-magnet"></i></a> 
                                      </div>
                                      <div>Charges : {{  $item['Amount'] }} </div>
                                      <div>Status :  {{  $item['Status'] }}
                                        <a href="javascript:"
                                        data-param="{{openssl_encrypt(json_encode($item),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
                                        data-url="{{ route('changestatus') }}" 
                                        data-size="md" 
                                        title="Edit Area" 
                                        class="load-popup text-dark edit-btn btn btn-default btn-circle">
                                        <i class="fas fa-info text-primary"></i>
                                        </a>
                                    </p>
                                  
                                  </div>
                                </div>
                              </td>
                              </tr>
                            @endforeach
                       
                        </tbody>
                       
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
           
           
        </div>
      
 
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- @include('addproduct') --}}
  </div>
  
  <script>
 

    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,"stripeClasses" :['black'], 
        "pagingType": "full_numbers",
   "paging": true,
   "lengthMenu": [10, 25, 50, 75, 100],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <style>
  
  </style>

@endsection
