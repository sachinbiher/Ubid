@extends('partnerpanel.layout')
<style>
.styled-checkbox
{
	width:auto!important;
	margin-right:5px;
	margin-left:10px;
	cursor: pointer;
}
.important {
        color: red;
    }
</style>
@section('content')
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
	<div class="content-body">
		<!-- e-commerce details start -->
		<section class="app-ecommerce-details">
			<div class="card">
				<!-- Product Details starts -->
				<div class="card-body">
					<div class="row my-2">
						<div class="col-12 col-md-7">
							
								@php $categoryval = App\Models\Category::where('id',$requirements->category_id)->first();
									$subcategoryval = App\Models\ChildCategory::where('id',$requirements->sub_category_id)->first();
										
								@endphp		 
								@php $cityname = App\Models\Cities::where('id',$requirements->location)->first(); @endphp
								@if($categoryval) <div style='color:#000;font-weight:600;font-size:18px;' class="badge bg-light rounded mr-1 mt-0">CATEGORY : {{$categoryval->name}} </div> @endif

								@if($subcategoryval) <div style='color:#000;font-weight:600;font-size:20px;' class="badge bg-light rounded mr-1 mt-0"> SUB CATEGORY NAME : {{$subcategoryval->name}} </div> @endif 
								<br><br>
							<span class="card-text item-company">Posted on :<a href="javascript:void(0)"
								class="company-name">{{date('d M, Y', strtotime($requirements->created_at))}}</a></span>
							<p class="card-text"><i data-feather="map-pin"></i> - <span
								class="text-success">{{empty($cityname) ? '': $cityname->name}}</span></p>
						</div>
						<div class="col-12">
							<hr />
						</div>
						<div class="col-12 col-md-7">
							<div class="d-flex flex-column flex-sm-row">
						
								<button type="button" class="btn btn-success  mr-0 mr-sm-1 mb-1 mb-sm-0">
											<a style='color:white;' href="{{route('ppanel.setwishlist',['rid'=>$requirements->id])}}">
											<i data-feather="heart" class="mr-25"></i>
											<span class="add-to-cart">Add to Wishlist</span></a>
								</button>
								

								<a href="javascript:void(0)" class="btn btn-light border mr-0 mr-sm-1 mb-1 mb-sm-0"
									rippleEffect>
								<i class="fa mr-50"></i>
								<span>Max Budget - ₹ {{$requirements->max_budget}}</span>
								</a>
							</div>
						</div>
						<div class="col-12">
							<hr />
						</div>
						<div class="col-12">
							<h2 class="font-weight-bolder">{{$requirements->name}}</h2>
							<!-- <p class="card-text">Description:</p>	 -->
							<p class="card-text">
								{{$requirements->description}}
							</p>
						
							<div class='row'>
							@foreach($columns as $col)
							@if($col !='attachment' && $col !='category_id' && $col !='customer_id' && $col !='max_budget' &&
							$col !='created_at' && $col !='updated_at' && $col !='sub_category_id' && 	$col !='bid_expire_date' && 
								$col !='floor_plan' && 	$col !='location' && $col !='total_area' && $col !='description' && $col !='name' &&
							$col !='max_budget' && $col !='id' && $col !='status' && $requirements->$col != null)
							@if( $requirements->$col  == '1' )
								<div class="card-text col-md-3" style=' text-transform: capitalize !important;'><b>{{str_replace('_',' ',$col)}} : </b>{{ $requirements->$col==1 ? 'Yes':'No' }}</div>	
							@elseif( $requirements->$col  != '0' )
								<div class="card-text col-md-3" style=' text-transform: capitalize !important;'><b> {{str_replace('_',' ',$col)}} : </b>{{ $requirements->$col }}</div>	
							@endif
							@endif
							@endforeach
							</div>
							<!-- <div class='row'>
							<div class="card-text col-md-3"><b>Total Area: </b> {{$requirements->total_area}} sqft.</div>	
							<div class="card-text col-md-3"> <b>Is Customer Negotiable :</b> {{$requirements->negotiable==1 ? 'Yes':'No'}} </div>
							<div class="card-text col-md-3"><b>Wanted 2D Designs : </b> {{$requirements->designs_2d ==1 ? 'Yes':'No'}} </div>	
							<div class="card-text col-md-3"><b>Wanted 3D Designs :  </b> {{$requirements->designs_3d ==1 ? 'Yes':'No'}} </div>	
							
							</div> -->
						</div>


						<div class="col-12">
							<hr />
						</div>
						<div class="col-12 col-md-7">
							<h4 class="font-weight-bolder">About Client</h4>
							@php $customer_info = App\Models\Customer::where(['status'=>1,'id'=>$requirements->customer_id])->whereNull('deleted_at')->first(); @endphp
							
							<p class="card-text"><i data-feather="user" class="custom-icon"></i> - <span
								class="text-dark">{{$customer_info->name}}</span></p>
							@php $projectposts = App\Models\Requirements::where('customer_id',$requirements->customer_id)->count(); @endphp
							<p class="card-text" style="padding-left: 3px;"><i data-feather="briefcase"></i> - <span
								class="text-dark">{{$projectposts}} Projects posted</span></p>
							
							<p class="card-text">
								{{$customer_info->about_us}}
							</p>
						</div>
						<div class="col-12 col-md-5 text-center my-auto">
							<button class="btn btn-success"  onclick="getdetails(this)" id='{{$requirements->id}}' data-toggle="modal" data-target="#ViewModal" >View Contact Details</button>
						</div>
						<div class="col-12">
							<hr />
						</div>
						<div class="col-12 col-md-8">
							<br />
							
							<form class="submitbid" id="submitbid" action="{{route('ppanel.submitbid')}}"
							method="post" enctype="multipart/formdata">
							<input type='hidden' id='projectid' name='projectid' value='{{$requirements->id}}'>
							<input type='hidden' id='vendor_id' name='vendor_id' value="{{Session::get('id')}}">
							{!! csrf_field() !!}
							<h4 class="text-brand">Select categories for which you would like to bid <span class='important'>*</span></h4>


							@php $categories = App\Models\Category::where('id',$requirements->category_id)->where('status',1)->whereNull('deleted_at')->orderBy('name','asc')->get(); @endphp
									
							<div class="row">
								<div class="col-xl-8 col-md-6 col-12 mb-1">
									<div class="form-group">
										<select class="floating-select select2 form-control category-select" placeholder="Primary Services" value="" name="category[]" id="category" multiple="multiple">
											<option value="">Select Category</option>
											
											@foreach($categories as $category)
											@if($category->name !='2D DESIGNS' && $category->name !='3D DESIGNS'  )
											<option value="{{$category->id}}">{{$category->name}}</option>
											@endif
											@endforeach
											
											<option value="37">2D DESIGNS</option>
											<option value="38">3D DESIGNS</option>
											
										</select>
										<span class="highlight">{{$errors->first('category')}}</span>
									</div>
								</div>
							</div>
							<h4 class="text-brand">Enter your best rate to win this project ?</h4>
							<div class="row">
								<div class="col-xl-4 col-md-6 col-12 mb-1">
									<div class="form-group">
										<input type="number" class="form-control" id="bidamount" name='bidamount'
											placeholder="₹ Enter Amount" />
										<span style='color:red;' class="highlight">{{$errors->first('bidamount')}}</span>
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-12 mb-1">
									<button type='submit' class="btn btn-success">Place Bid</button>
									<!-- <button class="btn btn-success"  onclick="getdetails(this)" id='{{$requirements->id}}' data-toggle="modal" data-target="#ViewModal" >Place Bid</button> -->
								</div>
							</div>

							<div class="row">
							<div class="col-xl-12 col-md-6 col-12 mb-1">
								<label class="label-note">
									<input type="checkbox" class="styled-checkbox" name="negotiable" id="negotiable"/>
									<b style="font-size:14px;">Negotiable</b>
								</label>
								<span class="highlight">{{$errors->first('negotiable')}}</span>	
							
								<!-- <label class="label-note" >
									<input type="checkbox" class="styled-checkbox" name="2d_designs" id="2d_designs"/>
									<b style="font-size:14px;">2D Designs</b>
								</label>
								<label class="label-note">
									<input type="checkbox" class="styled-checkbox" name="3d_designs" id="3d_designs"/>
									<b style="font-size:14px;">3D Designs</b>
								</label>
								<span class="highlight">{{$errors->first('2d_designs')}}</span>
								<span class="highlight">{{$errors->first('3d_designs')}}</span> -->
							</div>
							</div>
							
							
						
							<p><small class="text-danger"><b>Note : Your bid amount must not exceed Max Budget set by the customer.</b></small></p>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Product Details ends -->
		</section>
		<!-- e-commerce details end -->
	</div>
	<!-- E-commerce Content Section Starts -->
	<!-- E-commerce Content Section Starts -->
	<!-- background Overlay when sidebar is shown  starts-->
	<div class="body-content-overlay"></div>
	<!-- background Overlay when sidebar is shown  ends-->
</div>

<div class="modal fade text-left" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="ViewModalid" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered"  role="dialog">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h4 class="modal-title text-primary" id="ViewModalid">Contact Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body p-2">
				<div class="row">
					<div class="form-group col-md-12" id='textchangemsg'>
					
					</div>
				</div>
		
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function getdetails(n)
{
    
	$.ajax({
            method: 'get',
            url: '{{route("ppanel.getbidstatus")}}',
            data: {
                'projectid': n.id,
				_token: '{{csrf_token()}}'
            },
            success: function(data) {
				if(data.bidstatus.length == '0' )
				 	$("#textchangemsg").html('Place the Bid to view details!');	
				else
				{	
					if(data.bidstatus[0].status == '0')
						{
							if(data.subscription.subscriptiontype.viewaccepted_pro=='no')
								$("#textchangemsg").html('<h5>Basic Subscription</h5><p>Contact details would be shown once the bid gets accepted by the client. </p><p>Upgrade to <a href="{{route('subscriptionDetails')}}" >Go Pro membership</a>, to see the contact details without waiting for bids to be accepted.');	
							else
							getcustomerdetails(n.id);
						}	
					else
					{
						getcustomerdetails(n.id);
					
					}
						
						
					
				}
					 

            }
        });

}

function getcustomerdetails(x)
{
	$.ajax({
            method: 'get',
            url: '{{route("ppanel.customerinfo")}}',
            data: {
                'projectid': x,
				_token: '{{csrf_token()}}'
            },
            success: function(data) {
				if(data.length == '0' )
				 	$("#textchangemsg").html('No Contact Details');	
				else
				{	
					$("#textchangemsg").html('<p class="details"><b>Name : </b>'+data.name+'</p><p class="details"><b>Email : </b>'+data.email+' </p><p class="details"><b>Mobile Number : </b>+91 '+data.mobile+'</p>');	
					
				}
            }
        });

}

</script>
<!-- </p> -->
@stop