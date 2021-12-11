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
                  {{-- <!--li class="breadcrumb"><a class="btn btn-primary mx-2" href="{{ route('organisation-page')}}"><i class="fas fa-plus mx-1"></i>New</a></li--> --}}
                  <li class="breadcrumb">
                    
                    {{-- <!--a   href ="{{ route('addorganisation') }}"  class="btn btn-primary mx-2" data-toggle="modal" data-target="#modalAddProduct"--> --}}
                      
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
                      data-url="{{ route('addorganisation') }}" data-size="md" title="Edit Area" class="load-popup btn btn-primary mx-2  "> 
                  <i class="fas fa-plus mx-1"></i>New</a>
                          {{-- <h3 class="card-title">Service item with default features</h3> --}}
                          
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <?php //dd($collection) ?>
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Code</th>
                              <th>Name</th>
                              <th>ContactNo1</th>                              
                              <th>ContactNo2</th>
                              <th>Address</th>
                              <th>Email</th>
                              <th>DateOfFoundation</th>
                              <th>CELicenseNo</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $item)
                                
                                <tr>
                                    <td>{{  $item['Code'] }}</td>
                                    <td>{{  $item['Name'] }} </td>                                    
                                    <td>{{  $item['ContactNo1'] }}</td>
                                    <td>{{  $item['ContactNo2'] }}</td>
                                    <td>{{  $item['Address'] }}</td>
                                    <td>{{  $item['Email'] }}</td>
                                    <td>{{  $item['DateOfFoundation'] }}</td>
                                    <td>{{  $item['CELicenseNo'] }}</td>
                                    <td><div class="edit-icon">
                                    
<?php $service['OrganisationID']=$item['MasterID'] ?>
<?php $service['OrganisationData']=$item ?>
{{-- {{ $service['OrganisationData']=$item }} --}}
              <a href="javascript:;" data-real="{{ $item['MasterID'] }}" 
              data-param="{{openssl_encrypt(json_encode($item),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
              data-url="{{ route('addorganisation') }}" data-size="md" title="Edit Area" 
              class="load-popup text-white edit-btn btn btn-info "><i class="fas fa-pencil-alt"></i> Edit</a>

<a href="javascript:" data-param="{{openssl_encrypt(json_encode($service),"AES-128-ECB",md5(env('ENC_SALT'))) }}" 
data-url="{{ route('addservice') }}" data-size="md" title="Edit Area"  class="load-popup btn btn-primary ml-1"><i class="fas fa-plus"></i> Service</a>

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
        {{-- @include('addorganisation') --}}
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
