@extends('admin.master')
@section('content')

  
  
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">{{ $title }} </h1>
                
                    
                
                
              </div><!-- /.col -->
              <div class="col-sm-6">
                
                <ol class="breadcrumb float-sm-right">
                  {{-- <!--li class="breadcrumb"><a class="btn btn-primary mx-2" href="{{ route('cancellation-page')}}"><i class="fas fa-plus mx-1"></i>New</a></li--> --}}
                  <li class="breadcrumb">
                    
                    {{-- <!--a   href ="{{ route('addcancellation') }}"  class="btn btn-primary mx-2" data-toggle="modal" data-target="#modalAddProduct"--> --}}
                      
                </li>
                  
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">{{ $name }}</li> 
                  
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
                          <a href="javascript:;" data-real="{{ $new['MasterID'] }}" 
                      data-param="{{openssl_encrypt(json_encode($new),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
                      data-url="{{ route('addcancellation') }}" data-size="md" title="Edit Area" class="load-popup btn btn-primary mx-2  "> 
                  <i class="fas fa-plus mx-1"></i>New</a>
                          {{-- <h3 class="card-title">Cancellation item with default features</h3> --}}
                          
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <?php //dd($collection) ?>
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Code</th>
                              <th>BookingID</th>
                              <th>CancellationNo</th>                              
                              <th>CancellationID</th>
                              <th>Amount</th>
                              <th>ReturnReason</th>
                              <th>TestID</th>
                              <th>CancellationDate</th>     
                              <th>Origin</th>                         
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $item)
                                
                                <tr>
                                    <td>{{  $item['Code'] }}</td>
                                    <td>{{  $item['BookingID'] }} </td>                                    
                                    <td>{{  $item['CancellationNo'] }}</td>
                                    <td>{{  $item['CancellationID'] }}</td>
                                    <td>{{  $item['Amount'] }}</td>
                                    <td>{{  $item['ReturnReason'] }}</td>
                                    <td>{{  $item['TestID'] }}</td>
                                    <td>{{  $item['CancellationDate'] }}</td>
                                    <td>{{  $item['Origin'] }}</td>                                   
                                    <td><div class="edit-icon">
                                    
<?php $service['CancellationID']=$item['MasterID'] ?>
<?php $service['CancellationData']=$item ?>
{{-- {{ $service['CancellationData']=$item }} --}}
              <a href="javascript:;" data-real="{{ $item['MasterID'] }}" 
              data-param="{{openssl_encrypt(json_encode($item),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
              data-url="{{ route('addcancellation') }}" data-size="md" title="Edit Area" 
              class="load-popup text-white edit-btn btn btn-info "><i class="fas fa-pencil-alt"></i> Edit</a>

<a href="javascript:" data-param="{{openssl_encrypt(json_encode($service),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
data-url="{{ route('addcancellation') }}" data-size="md" title="Edit Area"  class="load-popup btn btn-primary ml-1"><i class="fas fa-plus"></i> Service</a>

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
        {{-- @include('addcancellation') --}}
      </div>

      <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
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

@endsection
