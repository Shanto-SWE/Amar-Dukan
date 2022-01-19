@php
$shop_slug=Session::get('shop')['shop_slug'];
$shop_id=Session::get('shop')['id'];
$category=DB::table('categories')->orderBy('category_name','ASC')->where('shop_id',$shop_id)->get();

@endphp

<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">categories</div>
								</div>

								<ul class="cat_menu">
								@foreach($category as $row)	
								@php
								  $subcategory=DB::table('sub_categories')->where('category_id',$row->id)->get();
								@endphp
									<li class="hassubs">
									<img class="catmenuimg " src="{{asset($row->category_logo)}}" alt="">	<a href="{{route('subcategorylist.show',$row->category_slug)}}">{{ $row->category_name }}<i class="fas fa-chevron-right"></i></a>
									    <ul>
									        @foreach($subcategory as $row)
									        
									        <li class="hassubs">
											<img class="catmenuimg img-fluid" src="{{asset($row->subcat_logo)}}" alt=""><a href="{{route('categorywishproduct.show',$row->Subcat_slug)}}">{{ $row->Subcategory_name }}</a>
									          
									        </li>
									        @endforeach
									    </ul>
									</li>
								@endforeach	
								</ul>
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
                                <li><a href="{{route('website.home',$shop_slug)}}">Home<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="">Campaign<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{route('product.discount')}}">Discount<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{route('product.request')}}">Product Request<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{route('contact')}}">Contact<i class="fas fa-chevron-down"></i></a></li>
					
								</ul>
							</div>
						<!-- Menu Trigger -->
							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</nav>
				
	<!-- Menu -->

	<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							<ul class="page_menu_nav">
				
							<li class="page_menu_item">
									<a href="{{route('website.home',$shop_slug)}}">Home<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="#">Campaign<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="{{route('product.discount')}}">Discount<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="{{route('product.request')}}">Product Request<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="#">Contact<i class="fa fa-angle-down"></i></a>
								</li>
							
				
								<li class="page_menu_item">
									<a href="{{route('user.loginwithemail')}}">Login<i class="fa fa-angle-down"></i></a>
								</li>
							</ul>
							
							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="images/phone_white.png" alt=""></div>+8801907-925559</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="images/mail_white.png" alt=""></div><a href="mailto:fastsales@gmail.com">shanto35-303@diu.edu.bd</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>