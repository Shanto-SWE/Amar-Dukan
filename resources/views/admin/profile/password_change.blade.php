@extends('layouts.admin')

@section('title','Password_change')
@section('admin_content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Password Change</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  
        <div class="row">
          <div class="col-6 offset-3">
          @if ($errors->any())
                        <div class="alert alert-danger mt-3 mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div class="card card-primary">
       
              <div class="card-header">
          
                <h3 class="card-title">Change Your Password</h3>
              </div>

              <form action="{{route('admin.password.update')}}" method="Post">
              @csrf
             
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="password" class="form-control" name="old_password" id="exampleInputEmail1" placeholder="Old Password" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword2">New Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword2" placeholder="New Password" required>
                  
                  </div>
                  

                  <div class="form-group">
                    <label for="exampleInputPassword3">Confirm Password</label>
                    <input type="password" class="form-control" name="ConfirmPassword" id="exampleInputPassword3" placeholder="ConfirmPassword" required>
                  </div>
                </div>
    

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary w-100">Update Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </div>

@endsection
