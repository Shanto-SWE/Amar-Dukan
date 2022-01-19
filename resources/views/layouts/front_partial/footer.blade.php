	<!-- Footer -->

	@php
	$category=DB::table('categories')->take(5)->get();
	$subcategory=DB::table('sub_categories')->take(5)->get();
	$page=DB::table('pages')->orderBy('id',"DESC")->get();
	$settting=DB::table('Settings')->get();

	@endphp

	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container footerlogocontain">
							<div class="logo text-white"><a href="#" class="text-white footerlogo"><img class="mainlogo" src="{{ asset($setting->logo) }}" alt=""></a></div>
						</div>
						<div class="footer_title text-white">Got Question? Call Us 24/7</div>
						<div class="footer_phone text-white">{{$setting->phone_one}}</div>
						<div class="footer_contact_text">
							<p class="text-white">{{$setting->address}}</p>
							
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>
						
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-7 ">
				<div class="footer_title text-warning">About amar dukan</div>
				<p>Amar Dukan is an online grocery and stationery Shop in all over of Bangladesh for your daily, weekly and monthly grocery bazaar through online. Amar Dukan delivers all kind of grocery and stationery items such as cooking items, beverage, bread & bakery, snacks, milk & dairy, beauty and body care, baby care, health care, home & cleaning items and other daily needs to customer doors by ensuring quality, faster delivery and reasonable price. We are ready to manage customers’ hassle regarding daily, weekly and monthly grocery bazaar by our own expertise to save customer time, energy and money. Amar Dukan also provides specialized service for the corporate clients. Let purchase from our online grocery and stationary shop with smooth delivery and get best service experience from Amar Dukan online grocery and stationary shop.

</p>
				</div>

			
               

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title text-warning mx-4">Information</div>
						<ul class="footer_list">
							@if(Session()->has('user'))
							<li><a href="{{route('user.dashboard')}}">My Account</a></li>
							@endif
							@if(Session()->has('shop'))
							<li><a href="{{route('wishlist.show')}}">Wish List</a></li>
							@endif
							<li><a href="{{route('order.tracking')}}">Order Tracking</a></li>
							<li><a href="{{route('contact')}}">Contact us</a></li>
							<li><a href="{{route('shoper.registration')}}">Become a vendor</a></li>
							@foreach($page as $row)
							<li><a href="{{route('page',$row->page_slug)}}">{{$row->page_name}}</a></li>
							@endforeach
					
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content text-white">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 

</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
					
							<li><a href="#"><img class="footerimg" src="https://www.evercarebd.com/wp-content/uploads/2020/04/BKASH-LOGO-Copy.jpeg" alt=""></a></li>
								<li><a href="#"><img class="footerimg" src="https://play-lh.googleusercontent.com/EQC9NtbtRvsNcU1r_5Dr8pWm3hPfN3OjGjzkOqzCEPDJvqBGKyfU9-a2ajNtcrIg1rs" alt=""></a></li>
								<li><a href="#"><img class="roket footerimg" src="https://iconape.com/wp-content/files/fy/184568/svg/184568.svg" alt=""></a></li>
								<li><a href="#"><img class="footerimg" src="https://www.mawbiz.com.bd/application/views/module/logo_image/aamarpay_logo.png" alt=""></a></li>
								<li><a href="#"><img class="footerimg" src="https://img2.pngio.com/cash-on-delivery-png-5-png-image-cash-on-delivery-png-350_200.png" alt=""></a></li>
					
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61b8d62380b2296cfdd1b571/1fmt08v5i';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->