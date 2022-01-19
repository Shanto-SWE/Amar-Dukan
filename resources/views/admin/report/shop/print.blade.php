<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                    <h3><b>Amar Dukan</b></h3>
                    <p>(Online Grocery Store)</p>
                    <h5>All Shop Details</h5>
                </div>
            </div>
        </div>
    </div>

    <table class=" w-100 table-bordered mt-4 printshop">
        <thead>
        <tr>
                      <th>SL</th>
                      <th>Owner Photo</th>
                      <th>Owner Name</th>
                       <th>Shop Name</th>
                       <th>District</th>
                      <th>city</th>
                      <th>Area</th>
                      <th>Phone</th>
                      <th>Registration Date</th>
                      <th>Status</th>
               
        </tr>
        </thead>
        <tbody>
            @foreach($shop as $key=>$row)
            <tr>
                <td><h6 class="p-0 m-0">{{++$key}}</h6></td>
                <td>
                <div style="max-width: 70px; max-height:70px;overflow:hidden">
                <img src="{{ asset($row->shop_owner_photo) }}" class="img-fluid img-rounded" alt="">
                </div>
                 </td>
                <td><h6 class="p-0 m-0">{{$row->shop_owner_name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->shop_name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->district_name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->shop_city}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->shop_area}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->shop_phone}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->registration_date}}</h6></td>
                <td><h6 class="p-0 m-0">

                @if($row->status==0)
                Inactive
                @else($row->status==1)
               Active
                @endif
                    
            </tr>
            @endforeach
        </tbody>
</table>
</div>