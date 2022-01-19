<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                <h3><b>Amar Dukan</b></h3>
                    <p>(Online Grocery Store)</p>
                    <h5>All Customer Details</h5>
                </div>
            </div>
        </div>
    </div>

    <table class=" w-100 table-bordered mt-4 ">
        <thead>
        <tr>
                      <th>SL</th>
                      <th>Customer Name</th>
                      <th>Customer Email</th>
                      <th>Customer Phone</th>
                      <th>Registration Date</th>
               
               
        </tr>
        </thead>
        <tbody>
            @foreach($user as $key=>$row)
            <tr>
                <td><h6 class="p-0 m-0">{{++$key}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->FullName}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->email}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->phone}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->registration_date}}</h6></td>
      
               
            </tr>
            @endforeach
        </tbody>
</table>
</div>