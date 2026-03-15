@extends('partnerpanel.layout')

@section('content')
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
	<!-- <div class="content-header row">
		<div class="content-header-left col-md-12 col-12">
			<div class="card alert-custom pt-1" >
				<div class="d-flex justify-content-between align-items-center row">
					<div class="col-1 dollar-symbol">
						₹
					</div>
					<div class="col-md-8 user_plan">
						<h2><strong>{{$subscriptiontype->name}} Plan</strong></h2>
						<p class="mb-0">{{$subscriptiontype->description}}</p>
						@if($subscriptiontype->period_months == 0)
						<p class="mb-0">Please subscribe to place unlimited bids</p>
						<p class="text-ellipsis text-secondary">Choose among multiple available plans based on your need.</p>
						@endif
								</div>
					<div class="col-md-2 user_status d-flex flex-column mx-1">
						<a  href="{{route('subscriptionDetails')}}" class="btn btn-primary">Subscribe now</a>
						<a href="{{route('ppanel.support')}}" class="btn btn-outline-secondary my-1">Contact us</a>
					</div>
				</div>
			</div>
<<<<<<< HEAD
		
=======
>>>>>>> 0434ac2451a43dc366f3223aa68713e8087e69be
		</div>
	</div> -->
	<div class="row">
		@if(count($wishlist)>0)
		@foreach($wishlist as $list)
		@php $projectinfo = App\Models\Requirements::where(['id'=>$list->requirement_id])->whereNull('deleted_at')->first();
							@endphp
		<div class="col-md-12">
			<div class="card ecommerce-card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-7">
							<div class="item-name">
								<h4 class="mb-0">
									<a class="text-body" href="{{route('ppanel.details',['id'=>$projectinfo->id])}}">
											@php $categoryval = App\Models\Category::where('id',$projectinfo->category_id)->first();
												 $subcategoryval = App\Models\ChildCategory::where('id',$projectinfo->sub_category_id)->first();
									
											@endphp
																						@if($projectinfo->category_id !='')<div style='color:#000;font-weight:600;' class="badge bg-light rounded mr-1 mt-0">CATEGORY : {{$categoryval->name}} </div> @endif
											@if($projectinfo->sub_category_id !='') <div style='color:#000;font-weight:600;' class="badge bg-light rounded mr-1 mt-0"> SUB CATEGORY NAME : {{$subcategoryval->name}} </div> @endif 				 
									
									</a>
								</h4>
								<span class="item-company">By <a href="javascript:void(0)"
									class="company-name">
									@php $customer_info = App\Models\Customer::where(['status'=>1,'id'=>$projectinfo->customer_id])->whereNull('deleted_at')->first(); @endphp
									{{$customer_info->name}}
								</a></span>
								<span class="item-company ml-1">Posted on {{date('d M, Y', strtotime($projectinfo->created_at))}}</span>
							</div>
							<!-- <span class="text-success mb-1">In Stock</span> -->
							<p class="delivery-date text-muted pt-1">{{$projectinfo->description}}
							</p>
							@php $totalbids = App\Models\Vendor_Bids::where('requirement_id',$list->requirement_id)->count(); @endphp
							<p class="mt-1 mb-0"><span class="text-muted"><b class="text-dark">Total Bids :
								</b>{{$totalbids}}</span><span class="text-muted ml-3"><b class="text-dark">Location :
								</b>{{$projectinfo->location}}</span>
							</p>
						</div>
						<div class="col-md-2">
							<h6 class="bg-light border p-1 text-center font-weight-bolder mt-5">Max Budget <br>
								₹{{$projectinfo->max_budget}}
							</h6>
						</div>
						<div class="col-md-3 mt-1">
							<div class="item-options text-center d-flex flex-column">
								<button type="button" class="btn btn-outline-secondary mt-1">
									<a href="{{route('ppanel.details',['id'=>$projectinfo->id])}}">View Details</a>
								</button>
								<button type="button" class="btn btn-outline-secondary mt-1"><span
									data-feather="x"></span>
									<a href="{{route('ppanel.removewishlist',['wid'=>$list->id])}}">Remove</a>
								</button>
								<button type="button" class="btn btn-success mt-1">
									<a href="{{route('ppanel.details',['id'=>$projectinfo->id])}}">Place Bid</a>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		@else
		<div class="col-md-12">
			<div class="card ecommerce-card">
				<div class="card-body">
					<h3>No Records Found</h3>
				</div>
			</div>
		</div>
		@endif
	</div>
	<div class="content-detached content-right">
		<div class="content-body">
			<!-- E-commerce Content Section Starts -->
			<!-- E-commerce Content Section Starts -->
			<!-- background Overlay when sidebar is shown  starts-->
			<div class="body-content-overlay"></div>
			<!-- background Overlay when sidebar is shown  ends-->
		</div>
	</div>
</div>
@stop