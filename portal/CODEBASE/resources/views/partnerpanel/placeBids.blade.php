@extends('partnerpanel.layout')

@push('PAGE_ASSETS_CSS')

<style>
	.show{
    left: -39%!important;
	}
	.profile-tabs .custom-checkbox.custom-control, .custom-radio.custom-control {
    padding: 0px 7px 1px 0px !important;
	}
	.black{
        color: red;
    }
</style>
@endpush

@section('content')
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">

	<div class="content-detached content-right">
		<div class="content-body">
			<!-- E-commerce Content Section Starts -->
			<section id="ecommerce-header">
				<div class="row">
					<div class="col-sm-12">
						<div class="ecommerce-header-items">
							<div class="result-toggler">
								<button class="navbar-toggler shop-sidebar-toggler" type="button"
									data-toggle="collapse">
									<span class="navbar-toggler-icon d-block d-lg-none"><i
											data-feather="menu"></i></span>
								</button>
								<div class="search-results">@php echo count($requirements) @endphp results found</div>
							</div>
							<div class="view-options d-flex">
								<div class="btn-group dropdown-sort">
									<button type="button" class="btn btn-outline-dark dropdown-toggle"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="active-sorting">Featured</span>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="javascript:sort(0);">Price:Low to High</a>
										<a class="dropdown-item" href="javascript:sort(1);">Price:High to Low</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- E-commerce Content Section Starts -->

			<!-- background Overlay when sidebar is shown  starts-->
			<div class="body-content-overlay"></div>
			<!-- background Overlay when sidebar is shown  ends-->

			<!-- E-commerce Search Bar Starts -->
			<section id="ecommerce-searchbar" class="ecommerce-searchbar">
				<div class="row mt-1">
					<div class="col-sm-12">
					<form>
						<div class="input-group input-group-merge">
							<input type="text" class="form-control search-product" id="categorysearch" value="{{ request()->searchproduct }}" 
								placeholder="Search Project" aria-label="Search..."
								aria-describedby="categorysearch" />
							<div class="input-group-append" style="cursor:pointer;">
								<span onclick='getsearch()' class="input-group-text"><i data-feather="search"
										class="text-muted"></i></span>
							</div>
						</div>
					</form>
					</div>
				</div>
			</section>
			<!-- E-commerce Search Bar Ends -->

			<!-- E-commerce Products Starts -->
			<section id="ecommerce-products">
				@if(count($requirements)==0)
				<p style="margin-top: 2%;margin-left: 40.5%;">No records found!</p>
				@else
				@foreach($requirements as $requirements)
				<div class="card ecommerce-card my-2">
					<div class="card-body">
						<div class="row">
							<div class="col-md-9">
								<div class="item-name">
									<h4 class="mb-0">
										<a class="text-body" href="{{route('ppanel.details',['id'=>$requirements->id])}}">
											<!-- {{$requirements->name}} -->
											@php $categoryval = App\Models\Category::where('id',$requirements->category_id)->first();
												 $subcategoryval = App\Models\ChildCategory::where('id',$requirements->sub_category_id)->first();
											@endphp
											@if(@$requirements->category_id !='')<div style='color:#000;font-weight:600;' class="badge bg-light rounded mr-1 mt-0">CATEGORY : {{@$categoryval->name}} </div>@endif
											@if(@$requirements->sub_category_id !='') <div style='color:#000;font-weight:600;' class="badge bg-light rounded mr-1 mt-0"> SUB CATEGORY NAME : {{$subcategoryval->name}} </div> @endif 				 
										</a>
										@if($requirements->attachment!=null)
										<span class="float-right mr-2">
											<i class="fal fa-paperclip atachement-file" style="color: #151515!important; cursor:pointer;" data-url="{{url($requirements->attachment)}}" data-toggle="modal"  onClick="showSlides($(this).data('url'))" data-target="#imgmyModal"  
											id="{{$requirements->attachment}}" aria-hidden="true" title="attachment"></i>
											<!-- <i class="fal fa-paperclip" style="color: #0099CC!important"aria-hidden="true"></i> -->
										</span>
										@endif

									</h4>
									
									@php $customer_info = App\Models\Customer::where(['status'=>1,'id'=>$requirements->customer_id])->whereNull('deleted_at')->first(); @endphp
							
									<span class="item-company">By : <a href="javascript:void(0)" class="company-name">{{$customer_info->name}}
											</a></span>
									<span class="item-company ml-1">Posted on : {{date('d M, Y', strtotime($requirements->created_at))}}</span>
								</div>
								<p class="delivery-date text-muted pt-1">{{$requirements->description}}</p>
								<br>
						


								@php $totalbids = App\Models\Vendor_Bids::where('requirement_id',$requirements->id)->count(); @endphp
								@php $cityname = App\Models\Cities::where('id',$requirements->location)->first(); @endphp
								
								<p class="mt-1 mb-0"><span class="text-muted"><b class="text-dark">Total Bids :
										</b>{{$totalbids}}</span><span class="text-muted ml-3"><b class="text-dark">Location :

										</b>{{@$cityname->name}}</span></p>
							</div>
							<div class="col-md-3 mt-2">
								<div class="item-options text-center">
									<div class="item-wrapper">
										<div class="item-cost">
											<p class="card-text shipping ng-star-inserted">
												<span class="badge badge-pill badge-light-success">Max Budget</span>
											</p>
											<h4 class="item-price">₹ {{$requirements->max_budget}}</h4>
										</div>
									</div>
									<div class="d-flex flex-column">
									

									@if($subscriptiontype->period_months <> '0' && $vendor->status==1) 
										<a class="btn btn-outline-secondary mt-1"  href="{{route('ppanel.details',['id'=>$requirements->id])}}" >View Details</a>
									@else
										<a class="btn btn-outline-secondary mt-1"  href="javascript:changestatus(4);" >View Details</a>
									
									@endif	
										<button type="button" class="btn btn-primary mt-1">
											<a style='color:white;' href="{{route('ppanel.setwishlist',['rid'=>$requirements->id])}}">Add to Wishlist</a>
										</button>
									</div>
								</div>
							</div>
						</div>  
					</div>
				</div>
				@endforeach
				@endif
			</section>
			<!-- E-commerce Products Ends -->
		</div>
	</div>


	<div class="sidebar-detached sidebar-left">
		<div class="sidebar">
			<!-- Ecommerce Sidebar Starts -->
			<div class="sidebar-shop">
				<div class="row">
					<div class="col-sm-12">
						<h6 class="filter-heading d-none d-lg-block">Filters</h6>
					</div>
				</div>
					<form id="filtersForm" method="GET" onsubmit="return validate()">
					{{-- csrf_field() --}}
						<div class="card">
							<div class="card-body">
								<!-- Price Filter starts -->
								<div class="multi-range-price">
									<h6 class="filter-title mt-0">Bid Range</h6>
									<ul class="list-unstyled price-range" id="price-range">
										<li>
											<div class="custom-control custom-radio" style="padding-left:0px!important;">
												<input type="number" value="{{ request()->min }}"  onkeyup="if(this.value<0){this.value= this.value * -1}" id="min" name="min" placeholder='Enter Min Value'
												class="form-control"  />  &nbsp;									
												<input type="number" value="{{ request()->max }}"  onkeyup="if(this.value<0){this.value= this.value * -1}" id="max" name="max" placeholder='Enter Max Value'
													class="form-control"  /> 	
												<p class="black" style='display:none;' id="check_filters_error">Minimum value cannot be more than Maximum value.</p>
											</div>
										</li>
										
									</ul>
								</div>
								<!-- Price Filter ends -->
								
								<!-- Categories starts -->
								<div class="brands">
										<h6 class="filter-title">Categories
										</h6>
										<ul class="list-unstyled brand-list">
											@php $categories = App\Models\Category::where('status',1)->whereNull('deleted_at')->get(); @endphp
										
											@foreach($categories as $category)
											<li>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input"
														id="{{$category->id}}" name="category[]" value='{{$category->id}}' 
														@if(request()->category) {{(in_array($category->id,request()->category) 
														? "checked='checked'": '')}} @endif
														 />
													<label class="custom-control-label" style="cursor:pointer;"
														for="{{$category->id}}">{{$category->name}}
													</label>
												</div>
											</li>
											@endforeach
										</ul>
									</div>
								<!-- Categories ends -->
								<!-- Time Filter Starts -->
								<div id="product-categories">
									<h6 class="filter-title">Time Filter</h6>
									<ul class="list-unstyled categories-list">
										<li>
											<div class="custom-control custom-radio" style="padding-left:0px!important">
												<input type="radio" id="category1" value="1" name="timefilter"
													class="custom-control-input" 	@if(request()->timefilter) {{ request()->timefilter == '1' 
														? "checked='checked'": ''}} @endif  />
												<label class="custom-control-label" for="category1">Today</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-radio" style="padding-left:0px!important">
												<input type="radio" id="category2" value="15" name="timefilter"
													class="custom-control-input"  	@if(request()->timefilter) {{ request()->timefilter == '15' 
														? "checked='checked'": ''}} @endif  />
												<label class="custom-control-label"  for="category2">Last 15days
												</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-radio" style="padding-left:0px!important">
												<input type="radio" id="category3" value= '30' name="timefilter"
													class="custom-control-input" 	@if(request()->timefilter) {{ request()->timefilter == '30' 
														? "checked='checked'": ''}} @endif  />
												<label class="custom-control-label" for="category3">Last 30days
												</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-radio" style="padding-left:0px!important">
												<input type="radio" id="category4" value= '60' name="timefilter"
													class="custom-control-input" 	@if(request()->timefilter) {{ request()->timefilter == '60' 
														? "checked='checked'": ''}} @endif  />
												<label class="custom-control-label" for="category4">Last 2 Months
												</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-radio" style="padding-left:0px!important">
												<input type="radio" id="category5" value= '90' name="timefilter"
													class="custom-control-input" 	@if(request()->timefilter) {{ request()->timefilter == '90' 
														? "checked='checked'": ''}} @endif  />
												<label class="custom-control-label" for="category5">Last 3 Months
												</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-radio" style="padding-left:0px!important">
												<input type="radio" id="category6" value='180' name="timefilter"
													class="custom-control-input" 	@if(request()->timefilter) {{ request()->timefilter == '180' 
														? "checked='checked'": ''}} @endif  />
												<label class="custom-control-label" for="category6">Last 6 Months
													</label>
											</div>
										</li>
									</ul>
								</div>
								<!-- Time Filter Ends -->

								<!-- Location Filter Starts -->
									<div class="brands">
							<h6 class="filter-title">Location</h6>
							<ul class="list-unstyled brand-list" >
								
									@php $cities = App\Models\Cities::whereNull('deleted_at')->get()->unique('name'); @endphp

									<select placeholder="Select Location" class=" select2 form-control " name="city[]" id="city" multiple="multiple">
									<option value=''>Select Location</option>
									@foreach($cities as $city)
                               			 <option value="{{$city->id}}">{{$city->name}}</option>
									@endforeach
                           			 </select>
							</ul>
						</div>
						<!-- Location Filter Ends -->
						<div id="apply-filters">
							<button type="submit" class="btn btn-success btn-block check_filters" id="check_filters">Apply Filters</button>
						</div>
						<br>
						<!-- Clear Filters Starts -->
						<div id="clear-filters">
							<a href="{{route('ppanel.placebids')}}" class="btn btn-primary btn-block">Clear All Filters</a>
						</div>
						<!-- Clear Filters Ends -->
					</form>
					</div>
				</div>
			</div>
			<!-- Ecommerce Sidebar Ends -->

		</div>
	</div>
</div>

<div class="modal fade text-left" id="imgmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h4 class="modal-title text-primary" id="myModalLabel1">Attachment</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-2">
				<div class="mySlides" style='display: none;'>
				<img id='banner' style="width:100%">
				</div>
			</div>
		</div>
	</div>
	</div>
<!-- <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script> -->
<script>
//image popup
function showSlides(n) {
    const img = document.getElementById("banner");
	console.log(n);
    img.onload = function () {};
    img.src = n;
    var slides = document.getElementsByClassName("mySlides");
    slides[0].style.display = "block";
}



function sort(type)
{
	window.location.href ='{{route("ppanel.placebids")}}?sort='+type;
}

function getsearch(){
	var search = (document.getElementById('categorysearch').value);
	window.location.href ='{{route("ppanel.placebids")}}?searchproduct='+search;
}

function validate(){
  	var min = document.getElementById("min").value;
	var max = document.getElementById("max").value;
	if(max<min ){
		$("#check_filters_error").css("display", "block");
		document.getElementById("min").value = null;
		document.getElementById("max").value = null;
		return false;
	}
	else{
		$("#check_filters_error").css("display", "none");
		return true;
	}
}
</script>
@stop