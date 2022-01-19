<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                <h3><b>Amar Dukan</b></h3>
                    <p>(Online Grocery Store)</p>
                    <h5>All Order Details</h5>
                </div>
            </div>
        </div>
    </div>

    <table class=" w-100 table-bordered mt-4">
        <thead>
        <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Shop_name</th>
                      <th>Total ({{ $setting->currency }})</th>
					  <th>Coupon Discount</th>
                      <th>After Discount ({{ $setting->currency }})</th>
                      <th>Payment Type</th>
                      <th>Date</th>
                      <th>Status</th>
               
        </tr>
        </thead>
        <tbody>
            @foreach($order as $key=>$row)
            <tr>
                <td><h6 class="p-0 m-0">{{++$key}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->c_name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->c_phone}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->shop_name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->total}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->coupon_discount}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->after_discount}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->payment_type}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->date}}</h6></td>
                <td><h6 class="p-0 m-0">

                @if($row->status==0)
                Pending
                @elseif($row->status==1)
                Recieved
                @elseif($row->status==2)
                Shipped
                @elseif($row->status==3)
                Completed
                @elseif($row->status==4)
                Return
                @else($row->status==5)
                Cancel
                @endif
                    </h6></td>
            </tr>
            @endforeach
        </tbody>
</table>
</div>