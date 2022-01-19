

<?php

$dataPoints = array(
  array("y" => $orderCount[4], "label" => $months[4]),
  array("y" =>  $orderCount[3], "label" => $months[3]),
  array("y" =>  $orderCount[2], "label" => $months[2]),
  array("y" =>  $orderCount[1], "label" => $months[1]),
  array("y" =>  $orderCount[0], "label" => $months[0]),

);
  
 ?>


@extends('layouts.admin')

@section('title','Order Chart')
@section('admin_content')
 <div class="content-wrapper">

   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Report Chart</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Report Chart</li>
             <li class="breadcrumb-item active">Order</li>
           </ol>
         </div>
       </div>
     </div>
   </div>

   
    <section class="content">
     <div class="container-fluid">
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Order Report Of Last 5 Month</h3>
             </div>

               <div class="card-body">
               <div id="chartContainer" style="height: 370px; width: 100%;"></div>
               </div>
             </div>
         </div>
     </div>
   </div>
</section>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
   title: {
       text: "Order Reports"
   },
   axisY: {
       title: "Number Of Order"
   },
   data: [{
       type: "line",
       dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
   }]
});
chart.render();

}
</script>
@endsection
