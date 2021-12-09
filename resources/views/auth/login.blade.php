@extends('admin.master')

@section('content')
    <div class="container-wrapper">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Login</h1>
                   
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">login</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Login with ID And Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="col-xl-3 col-md-4 col-md-offset-4 mx-auto my-5">
                                   
                                    <form action="{{route('login-user')}}" method="POST">
                                        @if(Session::has('success'))
                                        <div class="alert alert-success">{{Session::get('success')}}</div>
                                        @endif
                                        @if(Session::has('fail'))
                                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                        @endif
                                        @csrf
                                        <div class="form-group">
                                            <label for="loginid">ID</label>
                                            <input type="text" class="form-control" placeholder="Enter LoginID" name="loginid"
                                                value="{{old('loginid')}}">
                                            <span class="text-danger">@error('loginid'){{$message}} @enderror</span>
                                        </div>
                                        <div class=" form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Password" name="password"
                                                value="{{old('password')}}"">
                                            <span class="text-danger">@error('password'){{$message}} @enderror</span>
                                        </div>
                                        <div class=" form-group">
                                            <button class="btn btn-block btn-primary" type="submit">
                                                Login
                                            </button>

                                        </div>
                                        <br>
                                        <a href="registration">New User !! Register Here.</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
 @endsection