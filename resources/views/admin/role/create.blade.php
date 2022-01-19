@extends('layouts.admin')

@section('title','Role_Create')
@section('admin_content')

<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white;
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style>


  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Role</li>
            </ol>
          </div>
        </div>
      </div>
      <button class="w-100 btn btn-primary">Add New Role</button>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content mt-5">
      <div class="container-fluid">
       <form action="{{route('role.store')}}" method="post" enctype="multipart/form-data" id="add_form" >
        @csrf
       	<div class="row">
 
       <div class="col-md-3">
       <div class="form-group ">
                      <label for="exampleInputEmail1">Employee Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}"   required="" >
                    </div>
                    
       </div>
       <div class="col-md-3">
       <div class="form-group ">
                      <label for="exampleInputEmail1">Employee Email <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="email" value="{{ old('email') }}"  required="">
                    </div>
                    
       </div>
       <div class="col-md-3">
       <div class="form-group ">
                      <label for="exampleInputEmail1">Employee Phone <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"  required="">
                    </div>
                    
       </div>
       <div class="col-md-3">
       <div class="form-group ">
                      <label for="exampleInputEmail1">Password <span class="text-danger">*</span> </label>
                      <input type="password" class="form-control" name="password"   required="">
                    </div>
                    
       </div>
       <div class="col-md-3">
       <div class="form-group ">
                      <label for="exampleInputEmail1">Position <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="position" value="{{ old('position') }}"  required="">
                    </div>
                    
       </div>
     
       
           </div>
           <!-- all premession -->
           <div class="row mt-3">
             <div class="col-md-3">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="district" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    District
                </label>
                </div>
                
             </div>
             <div class="col-md-3">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="shop" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                   Shop
                </label>
                </div>
                
             </div>
             <div class="col-md-3">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="category" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Category
                </label>
                </div>
                
             </div>
             <div class="col-md-3">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="product" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Product
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="shipping_cost" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Shipping Cost
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="ticket" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Ticket
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="offer" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Offer
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="order" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Order
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="pickup_point" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Pickup Point
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="currency" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Currency
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="report_chart" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                   Report Chart
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="report" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                   Report
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="setting value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Setting
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="review" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Review
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="contect_message" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Contact Message
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="role" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Role
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subscriber" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                Subscriber
                </label>
                </div>
                
             </div>
             <div class="col-md-3 mt-2">
             <div class="form-check">
                <input class="form-check-input" type="checkbox" name="customer" value="1" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Customer
                </label>
                </div>
                
             </div>
         </div>
           <button class="btn btn-info ml-2 mt-4" type="submit">Submit</button>
         </div>
        
        </form>
      </div>
    </section>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{ asset('Backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>





 
  





@endsection