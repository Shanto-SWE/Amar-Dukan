<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                <h3><b>Amar Dukan</b></h3>
                    <p>(Online Grocery Store)</p>
                    <h5>All Product Details</h5>
                </div>
            </div>
        </div>
    </div>

    <table class=" w-100 table-bordered mt-3">
        <thead>
        <tr>
                     <th>SL</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Shop_name</th>
					  <th>quantity</th>
                      <th>stock</th>
                      <th>Unit</th>
                      <th>Selling Price(TK)</th>
                      <th>Discount Price(TK)</th>
                      <th>Category</th>
                      <th>Subcategory</th>
                      <th>Status</th>
               
        </tr>
        </thead>
        <tbody>
            @foreach($product as $key=>$row)
            <tr>
                <td><h6 class="p-0 m-0">{{++$key}}</h6></td>
                <td>
                <div style="max-width: 70px; max-height:70px;overflow:hidden">
                <img src="{{ asset('storage/files/products/'.$row->thumbnail) }}" class="img-fluid img-rounded" alt="">
                </div>
                 </td>
                <td><h6 class="p-0 m-0">{{$row->name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->shop_name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->quantity}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->stock_quantity}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->unit}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->selling_price}}</h6></td>
                @if($row->discount_price)
                <td><h6 class="p-0 m-0">{{$row->discount_price}}</h6></td>
                @else
                <td><h6 class="p-0 m-0">0.00</h6></td>
                @endif
                <td><h6 class="p-0 m-0">{{$row->category_name}}</h6></td>
                <td><h6 class="p-0 m-0">{{$row->Subcategory_name}}</h6></td>
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