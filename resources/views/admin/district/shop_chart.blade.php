<?php


foreach($getShopDistrict as $key=>$data){
    $dataPoints[$key]['label']=$getShopDistrict[$key]['district_name'];
    $dataPoints[$key]['y']=$getShopDistrict[$key]['count'];
}

 
?>
@extends('layouts.admin')

@section('title','Shop Report')
@section('admin_content')
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shop Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">District</li>
              <li class="breadcrumb-item active">Shop Report</li>
          
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
                <h3 class="card-title">Shop Report District Wish </h3>
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
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Registered Shops District Count"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##\" Shops\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

@endsection