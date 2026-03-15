@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
<style>
	.dt-button{
		display:none;
	}
	.required{
		color:red !important;
	}
	#profile_img
	{
		display: none;
	}
	#choose_file
	{
		display: none;
	}
	#profileimg
	{
		cursor: pointer;
	}
	.profile-img {
		width: 150px;
		height: 150px;
		overflow: hidden;
		-webkit-border-radius: 50%;
		-moz-border-radius: 50%;
		-ms-border-radius: 50%;
		-o-border-radius: 50%;
		border-radius: 50%;
	}

	.profile-img img {
		width: 150px;
		height: 150px;
	}
</style>
@endpush

@section('content')
<div class="">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
		<div class="content-body">
			<section class="parent-productlist advanced-search-datatable">
				@include('partner.tabs')
				</ul>
				<div class="col-12">
					<section id="advanced-search-datatable ">
						<div class="row">
							<div class="col-12">
								<div class="card table-filters-design">
									<div class="filter-tab-btn card-option ">
										<span class="minimize-card btn btn-primary "><i data-feather="filter"></i> Filters</span>
										<span style="display:none"><i data-feather="filter"></i> Filters</span></li>
									</div>
									<!--Search Form -->
									<div class="card-body " style="display:none;">
										<form method="POST">
											<div class="row">
												<div class="col-4">
													<div class="form-group">
														<label>Vendor id</label>
														<input type="text" class="form-control dt-input dt-organization" data-column="5" placeholder="Vendor id" name="fvendor" id="fvendor" value="{{request()->fvendor}}"/>
													</div>
												</div>
												<div class="col-4">
													<div class="form-group">
														<label>Name</label>
														<input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="Name" name="fname" id="fname" value="{{request()->fname}}"/>
													</div>
												</div>
												<div class="col-4">
													<div class="form-group">
														<label>Email ID</label>
														<input type="text" class="form-control dt-input dt-email" data-column="5" placeholder="Email ID" name="femail" id="femail" value="{{request()->femail}}"/>
													</div>
												</div>
												<div class="col-4">
													<div class="form-group">
														<label>Contact No.</label>
														<input type="text" class="form-control dt-input dt-contact-no" data-column="5" placeholder="Contact No." name="fmobile" id="fmobile" value="{{request()->fmobile}}"/>
													</div>
												</div>
												<div class="col-4">
													<div class="form-row mt-2">
														<button type="button" class="btn btn-primary mr-1" id="dt-feature-filter-form-search"><i class="fal fa-search"></i></button>
														<a href="{{route('partner')}}" class="btn btn-outline-secondary"><i class="fal fa-redo"></i></a>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="card basic-datatable table-fixedheader datatable-list">
										<table class="dt-business-partners table table-bordered table-responsive">
											<thead>
												<tr>
													<th>Vendor ID</th>
													<th>Name</th>
													<th>Email</th>
													<th>Contact</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!--/ Advanced Search -->
				</div>
			</section>
		</div>
	</div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
@php $states = \App\Models\State::get(); @endphp
@php $cities = \App\Models\Cities::get(); @endphp
<!--Modal View Documents -->

<div class="modal fade text-left" id="viewDocuments" tabindex="-1" role="document" aria-labelledby="viewDocumentsModal" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" style='max-width: 70%; max-height:50%;' role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h4 class="modal-title text-primary" id="viewDocumentsModal">View details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-2">

				 <section class="modern-horizontal-wizard w-80 mx-auto"> 
					<div>
						<span>Do you want to edit? </span> &nbsp;
						<button type="button" name="editRegister" id="editRegister"  class="btn btn-secondary btn-submit" >  Click Here!</button> 
					</div>
					<div id="stepper3" class="bs-stepper wizard-modern modern-wizard-example">
						<div class="bs-stepper-header">
							<div class="step step4 active" data-target="#personal-details-modern">
								<button type="button" class="step-trigger">
									<span class="bs-stepper-box">
										<i data-feather="file-text" class="font-medium-3"></i>
									</span>
									<span class="bs-stepper-label">
										<span class="bs-stepper-title">Personal Details</span>
										<span class="bs-stepper-subtitle">Setup Personal Details</span>
									</span>
								</button>
							</div>
							<div class="line">
								<i data-feather="chevron-right" class="font-medium-2"></i>
							</div>
							<div class="step step1" data-target="#account-details-modern">
								<button type="button" class="step-trigger">
									<span class="bs-stepper-box">
										<i data-feather="file-text" class="font-medium-3"></i>
									</span>
									<span class="bs-stepper-label">
										<span class="bs-stepper-title">Basic Details</span>
										<span class="bs-stepper-subtitle">Setup Profile Details</span>
									</span>
								</button>
							</div>
							<div class="line">
								<i data-feather="chevron-right" class="font-medium-2"></i>
							</div>
							<div class="step step2" data-target="#personal-info-modern">
								<button type="button" class="step-trigger">
									<span class="bs-stepper-box">
										<i data-feather="user" class="font-medium-3"></i>
									</span>
									<span class="bs-stepper-label">
										<span class="bs-stepper-title">Professional Info</span>
										<span class="bs-stepper-subtitle">Add Work Info</span>
									</span>
								</button>
							</div>
							<div class="line">
								<i data-feather="chevron-right" class="font-medium-2"></i>
							</div>
							<div class="step step3" data-target="#address-step-modern">
								<button type="button" class="step-trigger">
									<span class="bs-stepper-box">
										<i data-feather="map-pin" class="font-medium-3"></i>
									</span>
									<span class="bs-stepper-label">
										<span class="bs-stepper-title">Address</span>
										<span class="bs-stepper-subtitle">Add Address</span>
									</span>
								</button>
							</div>
						</div>
						<div class="bs-stepper-content">
						<form class="registerUpdate" id="registerUpdate" action="{{route('updateDetails')}}" method="post" enctype="multipart/formdata">
							<input type='hidden' id='vendorid' name='vendorid'>
							<input type='hidden' id='vendorrefid' name='vendorrefid'>
							
							{!! csrf_field() !!}
							<div id="personal-details-modern" class="content fade active dstepper-block">
								<div class="content-header">
									<!-- <h5 class="mb-0">Personal Details</h5>
									<small class="text-muted">Enter Your Details.</small> -->
								</div>
								<div class="row">
									<div class="col-lg-12">
										<h4>Personal Details</h4>
									</div> 
									<div class="col-lg-3">
										<fieldset class="form-group">
											<label for="file-upload-single" style="font-size:12px!important;">Upload Profile photo</label>
											<div class="custom-file">
												<input type="file" disabled='true' name="profile_img" id="profile_img" class="custom-file-input file-input3"   ng2FileSelect
													[uploader]="uploader" id="file-upload-single"  value='{{request()->profile_img}}' />
												<label class="custom-file-label file-label3" id="choose_file">Choose file</label>
												<span class="highlight">{{$errors->first('profile_img')}}</span>
											</div>
											<div class="profile-img">
												<img class="round img-fluid" id="profileimg" disabled='true' name="profileimg" width=100 alt="Card image" src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}">	
											</div>
										</fieldset>
									</div>
									<div class="col-lg-9" style="margin-top:5%">
										<input type="hidden" id="email" name="email" class="form-control" value="{{ Session::get('email') }}"/>
										<div class="form-group col-md-12">
											<label class="form-label" for="company" style="font-size: 20px!important;">Name<span class="required"> * </span></label>
											<p style="color:#151515"><i>If you own a business, please enter your Business Name. Freelancers may write their own name they wish to display in the profile.​</i></p>
											<input type="text" requried id="company" disabled='true' value="{{request()->company}}" name="company" class="form-control" placeholder="" required/>
											<span class="highlight">{{$errors->first('company')}}</span>
										</div>
									</div>
								</div>
								<div class="d-flex justify-content-between">
									<!-- <button type="button" class="btn btn-outline-secondary btn-prev" disabled  >
										<i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
										<span class="align-middle d-sm-inline-block d-none">Previous</span>
									</button> -->
									<button type="button"  class="btn btn-primary btn-next " id='next1' style="right: -90%;">
										<span class="align-middle d-sm-inline-block d-none" >Next</span>
										<i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
									</button>
								</div>
								<br>
								<p class="black" style='display:none;' id="black1">Please fill all the <span class="required"> * </span> marked fields.</p>
							</div>
							<div id="account-details-modern" class="content fade dstepper-none">
								<div class="content-header">
									<h5 class="mb-0">Basic Details</h5>
									<small class="text-muted">Enter Your Details.</small>
								</div>
								<div class="row">
									<div class="form-group form-password-toggle col-md-12">
										<label class="form-label" for="id_proof">Select Govt ID Proof<span class="required important"> * </span></label>
										<select  disabled='true' class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="" name="id_proof" id="id_proof" required>
											<option value="">Select</option>   
											<option value="aadhar" {{request()->id_proof=='aadhar'?'selected="selected"':''}}>Aadhar Card</option>
											<option value="pan" {{request()->id_proof=='pan'?'selected="selected"':''}}>PAN Card</option>
											<option value="driving" {{request()->id_proof=='driving'?'selected="selected"':''}}>Driving License</option>
											<option value="passport" {{request()->id_proof=='passport'?'selected="selected"':''}}>Passport</option>
											<option value="other" {{request()->id_proof=='other'?'selected="selected"':''}}>Other Government Id</option>
										</select>
										<span class="highlight">{{$errors->first('id_proof')}}</span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<h4>Select files</h4>
									</div>

									<div class="col-lg-6">	
										<fieldset class="form-group">
											<label for="file-upload-single">Front Photo:<span class="required important"> * </span></label>
											<div class="custom-file">
												<input disabled='true' type="file" name="front_img" id="front_img" class="custom-file-input file-input1" accept="application/pdf,image/jpeg,image/png" ng2FileSelect
													[uploader]="uploader" id="file-upload-single" value='{{request()->front_img}}' />
												<label class="custom-file-label file-label1">Choose file</label>
												<span class="highlight">{{$errors->first('front_img')}}</span>
											
												<button style='align:center;' type='button' class='btn btn-info' id='front1' value="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" data-toggle="modal" data-target="#imgmyModal" onclick="showSlides(this)" >View File</button>
											</div>
										</fieldset>
										
										
									</div>
					
									
									<div class="col-lg-6">
										
										<fieldset class="form-group">
											<label for="file-upload-single">Back Photo:<span class="required important"> * </span></label>
											<div class="custom-file">
												<input disabled='true' type="file" name="back_img" id="back_img" class="custom-file-input file-input2" accept="application/pdf,image/jpeg,image/png" ng2FileSelect
													[uploader]="uploader" id="file-upload-single" value='{{request()->back_img}}' />
												<label class="custom-file-label file-label2">Choose file</label>
												<span class="highlight">{{$errors->first('back_img')}}</span>
											</div>
											<button style='align:center;' type='button' class='btn btn-info' id='back1' value="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" data-toggle="modal" data-target="#imgmyModal" onclick="showSlides(this)" >View File</button>
										</fieldset>
									</div>
								</div>
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-primary btn-prev" id='pre4' >
										<i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
										<span class="align-middle d-sm-inline-block d-none">Previous</span>
									</button>
									<button type="button"  class="btn btn-primary btn-next " id='next2' >
										<span class="align-middle d-sm-inline-block d-none">Next</span>
										<i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
									</button>
								</div>
							</div>
							<div id="personal-info-modern" class="content fade dstepper-none">
								<div class="content-header">
								<h5 class="mb-0">Professional Info</h5>
                    			<small>Enter Your Professional Info.</small>
								</div>
								<div class="row justify-content-center">
									<div class="form-group col-md-8">
										<label class="form-label" for="projects_done">Number of Projects done?<span class="required important"> * </span></label>
										<input type="number"  disabled='true'  id="projects_done" value="{{request()->projects_done}}" name="projects_done" class="form-control" placeholder="" required/>
										<span class="highlight">{{$errors->first('projects_done')}}</span>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="form-group col-md-8">
										<label class="form-label" for="category">Select what services you would offer at UBID?<span class="required"> * </span>(<code>Note : You can add Multiple services that defines you.</code>)</label>
										<select disabled='true' class="floating-select select2 form-control category-select" placeholder="Primary Services" value="" name="category[]" id="category" multiple="multiple" required>
											<option value="">Select Category</option>
											@php $categories = App\Models\Category::where('status',1)->whereNull('deleted_at')->orderBy('name','asc')->get(); @endphp
											@foreach($categories as $category)
											<option value="{{$category->id}}">{{$category->name}}</option>
											@endforeach
										</select>
										<span class="highlight">{{$errors->first('category')}}</span>
									</div>
								</div>
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-primary btn-prev" id='pre1'   >
										<i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
										<span class="align-middle d-sm-inline-block d-none">Previous</span>
									</button>
									<button type="button" class="btn btn-primary btn-next" id='next3'   >
										<span class="align-middle d-sm-inline-block d-none">Next</span>
										<i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
									</button>
								</div>
							</div>
							<div id="address-step-modern" class="content fade dstepper-none">
								<div class="content-header">
									<h5 class="mb-0">Address</h5>
									<small>Enter Your Address.</small>
								</div>
								<div class="row justify-content-center">
								<div class="col-md-6">
									<div class="row">
										<div class="form-group col-md-12">
											<label class="form-label mr-2" for="modern-address">Address Type :<span class="required"> * </span></label>
											<div class="form-check form-check-inline mr-2">
												<input class="form-check-input" type="radio" name="adtype"
													id="adtype_home" disabled='true' value="home" checked />
												<label class="form-check-label" for="adtype_home">Home</label>
											</div>
											<div class="form-check form-check-inline mr-2">
												<input class="form-check-input" type="radio" name="adtype"
													id="adtype_office" disabled='true' value="office" checked />
												<label class="form-check-label" for="adtype_office">Office</label>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label class="form-label mr-2" for="address1">Address Line 1:<span class="required"> * </span></label>
											<!-- <fieldset class="form-group">
												<textarea class="form-control" id="basicTextarea" rows="3"
													placeholder="Enter the address where customers can fnd you"></textarea>
											</fieldset> -->
											<input type="text" disabled='true' id="address1" value="{{request()->address1}}" name="address1" class="form-control" placeholder="" required/>
											<span class="highlight">{{$errors->first('address1')}}</span>
										</div>
										<div class="form-group col-md-12">
											<label class="form-label mr-2" for="address2">Address Line 2 :</label>
											<input type="text" disabled='true' id="address2" value="{{request()->address2}}" name="address2"class="form-control" placeholder=""/>
											<span class="highlight">{{$errors->first('address2')}}</span>
										</div>
										<div class="form-group col-md-6">
											<label class="form-label mr-2" for="state">State :<span class="required"> * </span></label>
											<select class="form-control" onchange="changestate()" disabled='true' name="state" id="state" required>
												<option value="">Select State</option>
												@foreach($states as $state)
													<option value="{{$state->id}}">{{$state->name}}</option>
												@endforeach
											</select>
											<span class="highlight">{{$errors->first('state')}}</span>
										</div>
										<div class="form-group col-md-6">
											<label class="form-label mr-2" for="city">City :<span class="required"> * </span></label>
											<select class="form-control" disabled='true' name="city" id="city" required>
											@foreach($cities as $citys)
													<option value="{{$citys->id}}">{{$citys->name}}</option>
												@endforeach
											</select>
											<span class="highlight">{{$errors->first('city')}}</span>
										</div>
										
										<div class="form-group col-md-6">
											<label class="form-label mr-2" for="pincode">Pincode :<span class="required"> * </span></label>
											<input type="number" maxlength="6" oninput="this.value=this.value.slice(0,this.maxLength)" disabled='true' id="pincode" value="{{request()->pincode}}" name="pincode" class="form-control" placeholder="" required />
											<span class="highlight">{{$errors->first('pincode')}}</span>
										</div>
										<div class="form-group col-md-6">
											<label class="form-label mr-2" for="landmark">Landmark :</label>
											<input type="text" disabled='true' id="landmark" value="{{request()->landmark}}" name="landmark" class="form-control" placeholder="" />
											<span class="highlight">{{$errors->first('landmark')}}</span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label mr-2" for="modern-address">Locate on Map :</label>
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d487293.2774677608!2d78.12784000692413!3d17.412808363619543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99daeaebd2c7%3A0xae93b78392bafbc2!2sHyderabad%2C%20Telangana!5e0!3m2!1sen!2sin!4v1628189355642!5m2!1sen!2sin" width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
									</div>
								</div>
							</div>
								<div class="row justify-content-center align-items-center">
								</div>
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-primary btn-prev" id='pre2'>
										<i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
										<span class="align-middle d-sm-inline-block d-none">Previous</span>
									</button>
									<button type="submit" class="btn btn-success" name="registserSubmit" id="registserSubmit" style='display:none'
									value="registserSubmit"   >
										<span class="align-middle d-sm-inline-block d-none">Update</span>
										<i data-feather="arrow-right" class="align-middle mr-sm-25 mr-0"></i>
										</button> 
								</div>
							</div>
							</form>
						</div>
					</div>
					<br><br>
					<div class="text-center" id='changevendor' style='display:none;'>
						<a href="#" onclick='accept()'><span class="btn btn-success">Accept</span></a>
						<!-- <a href="#" id="'.$vendor->vendor_id.'2" data-toggle="modal" onclick="gethold(this)" data-target="#hold" ><span class="btn btn-info">Hold</span></a> -->
						<a href="#" onclick='reject()'><span class="btn btn-danger">Reject</span></a>
					<div>
				</section> 
			</div>
		</div>
	</div>
</div>

<!-- Modal Hold -->

<div class="modal fade text-left" id="holdModal" tabindex="-1" role="dialog" aria-labelledby="viewholdModal" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered"  role="dialog">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h4 class="modal-title text-primary" id="viewholdModal">Hold</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="registerUpdate1" id="registerUpdate1" action="{{route('partner.hold')}}"
							method="post" enctype="multipart/formdata">
				<input type='hidden' id='vendor_id' name='vendor_id'>
				{!! csrf_field() !!}
				<div class="modal-body p-2">
					<div class="col-md-12">
						<label class="form-label mr-2" for="holdmessage">Reason for Holding :<span class="required important"> * </span></label>
						<textarea class="form-control" maxlength='255' id="holdmessage" name="holdmessage"
									rows="5" required></textarea>
						<span class="highlight">{{$errors->first('holdmessage')}}</span>
					</div>			
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" name="holdSubmit" id="holdSubmit" value="holdSubmit"   >
						<span class="align-middle d-sm-inline-block d-none">Submit</span>
						<!-- <i data-feather="arrow-right" class="align-middle mr-sm-25 mr-0"></i> -->
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!--Image Popup -->

<div class="modal fade text-left" id="imgmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h4 class="modal-title text-primary" id="myModalLabel1">Image</h4>
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

@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
var Partners = function () {
   return { //main function to initiate the module
      init: function () {

		 var dt_ajax_table = $('.dt-business-partners');
            var dt_ajax_url = "{{$dt_ajax_url}}";
            var searchParams = '';

            @if(request()->get('search'))
                searchParams += '?';
                @foreach($dt_search_colums as $dt_search_colum)
                    @if(isset(request()->$dt_search_colum) && request()->$dt_search_colum != '')
                    searchParams += '&{{$dt_search_colum}}={{urlencode(request()->$dt_search_colum)}}';
                    @endif
                @endforeach

                dt_ajax_url += searchParams;
            @endif
            //------------------------------------------------------------------------//
            // Ajax Sourced Server-side
            // --------------------------------------------------------------------
            if (dt_ajax_table.length) {
                var dt_ajax = dt_ajax_table.dataTable({
                    processing: true,
                    serverSide: true,
                    dom: '<"row d-flex justify-content-between align-items-center m-1"' + '<"col-lg-2 d-flex align-items-center"l>' + '<"col-lg-4 "f>' + '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-wrap  p-0"<"dt-action-buttons text-right"B>>' + '>t' + '<"d-flex justify-content-between  mx-2"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
                    ajax: {
                        url: dt_ajax_url,
                        type: "POST"
                    },
                    'columnDefs': [{
                        'targets': 'no-sort',
                        'bSort': false,
                        'searchable': false,
                        'orderable': false,
                        'render': function (data, type, full, meta){
                            return full[0];
                        }
                    },
                    {
                        'targets': 1,
                        'className': 'id-anchor'
                    }],
                    displayLength: 10,
                    lengthMenu: [10, 50, 100],
                    language: {
                        sLengthMenu: 'Show _MENU_',
                        search: '',
                        searchPlaceholder: 'Search using Vendor ID',
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });
			}
				
            //filtering
            $('body').on('click', '#dt-feature-filter-form-search', function(e) {
                e.preventDefault();
                var url = "{{route('partner')}}?search=1";
                if($('#fname').val() != '') url += "&fname="+encodeURIComponent($('#fname').val());
                if($('#femail').val() != '') url += "&femail="+encodeURIComponent($('#femail').val());
                if($('#fmobile').val() != '') url += "&fmobile="+encodeURIComponent($('#fmobile').val());
                if($('#fvendor').val() != '') url += "&fvendor="+encodeURIComponent($('#fvendor').val());

                window.location.href = url;

            });
			
      }
   }
}();

jQuery(document).ready(function() {
   Partners.init();
});

$("#profileimg").click(function(e) {
        $("#profile_img").click();

    });

    function fasterPreview( uploader ) {
        if ( uploader.files && uploader.files[0] ){
            $('#profileimg').attr('src', 
                window.URL.createObjectURL(uploader.files[0]) );
        }
    }

$("#profile_img").change(function(){
    fasterPreview( this );
});

$('.custom-file-input').on('change', function(e) {
    var extension = e.target.files[0].name.split('.').pop().toLowerCase()
    var reader = new FileReader();
    reader.onload = function(e) {
        if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'pdf' || extension == 'jfif') {
            $('#profileimg').attr('src', reader.result);
        }
        else{
            alert('Allowed Extensions are : *.jpg ,*.jpeg ,*.png ,*.pdf')
            $('#profileimg').attr('src', 'partner-assets/app-assets/images/avatars/profile.png');
            
        }
    }
    reader.readAsDataURL(e.target.files[0]);
})

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

$("#editRegister").click(function(){
    $("#profileimg").attr('disabled',false);
    $("#profile_img").attr('disabled',false);
    $("#registserSubmit").css("display", "block")
    $("#id_proof").attr('disabled',false);
	$("#projects_done").attr('disabled',false);
	$("#company").attr('disabled',false);
	$("#address1").attr('disabled',false);
	$("#address2").attr('disabled',false);

	$("#city").attr('disabled',false);
	$("#state").attr('disabled',false);
	$("#pincode").attr('disabled',false);
	$("#landmark").attr('disabled',false);
	$("#adtype_office").attr('disabled',false);
	$("#adtype_home").attr('disabled',false);

	$('#back_img').attr('disabled',false);
	$('#front_img').attr('disabled',false);
	$('#profile_img').attr('disabled',false);
	$('#category').attr('disabled',false);
	jQuery('#editRegister').removeClass('btn btn-secondary btn-submit');
	jQuery('#editRegister').addClass('btn btn-success btn-submit');	
  });

  function changestate(n)
{
	var state_id = $("#state").val(); 
	// alert(state_id);
	$("#city").html('');
	$.ajax({
	url:"{{route('getcitiesbystate')}}",
	type: "POST",
	data: {
	state_id: state_id,
	_token: '{{csrf_token()}}' 
	},
	dataType : 'json',
		success: function(result){
		// document.getElementById("city").disabled = false;
		$('#city').html('<option value="">Select City</option>'); 
			$.each(result.cities,function(key,value){
			$("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
			});

		$("#city").val(n);
		}
	});
}
function getdetails(n)
{
	var id=n.id;
	$.ajax({
		url: "{{route('partner.view')}}", 
		type:'post',
		data: {id:id, _token: '{{csrf_token()}}'},
		success: function(result){
			
			$("#profileimg").attr('disabled',false);
			$("#profile_img").attr('disabled',true);
			$("#registserSubmit").css("display", "none")
			$("#id_proof").attr('disabled',true);
			$("#projects_done").attr('disabled',true);
			$("#company").attr('disabled',true);
			$("#address1").attr('disabled',true);
			$("#address2").attr('disabled',true);

			$("#city").attr('disabled',true);
			$("#state").attr('disabled',true);
			$("#pincode").attr('disabled',true);
			$("#landmark").attr('disabled',true);
			$("#adtype_office").attr('disabled',true);
			$("#adtype_home").attr('disabled',true);

			$('#back_img').attr('disabled',true);
			$('#front_img').attr('disabled',true);
			$('#profile_img').attr('disabled',true);
			$('#category').attr('disabled',true);
			jQuery('#editRegister').addClass('btn btn-secondary btn-submit');
			jQuery('#editRegister').removeClass('btn btn-success btn-submit');	

			$("#vendorid").val(id);
			$("#vendorrefid").val(result.id)
        	$("#id_proof").val(result.id_proof);
			$("#id_proof").trigger('change'); 
			

			$("#projects_done").val(result.no_of_projects);
			$("#company").val(result.company);
			$("#address1").val(result.address1);
			$("#address2").val(result.address2);
			$("#state").val(result.state_id);
			changestate(result.city)
			$("#city").val(result.city);
    
				
			$("#pincode").val(result.pincode);
			$("#landmark").val(result.landmark);
			if(result.id_proof_front != null)
				$('#front1').val(result.id_proof_front);
			if(result.id_proof_back != null)
				$('#back1').val(result.id_proof_back);
			if(result.photo != null && result.photo != '')
			// console.log(result.photo)
				$('#profileimg').attr('src',result.photo);
			if(result.photo == '' || result.photo == null)
			// console.log(result.photo)
            	$('#profileimg').attr('src', 'partner-assets/app-assets/images/avatars/profile.png');
			if(result.status ==3 || result.status ==2)
			{
				$("#changevendor").css("display", "block")
			}
			else{
				$("#changevendor").css("display", "none")
			}
	
			// $("#back_img").val(result.id_proof_back);
			// $("#front_img").val(result.id_proof_front);
			var arr =JSON.parse(result.services); 

			$("#category").select2().val(arr);
			$("#category").trigger('change');
			
		
			$('input[name=adtype][value="' + result.address_type + '"]').prop('checked', true);
		}
	});
}

$('#state').on('change', function() {
    
	var state_id = this.value;
	// alert(state_id);
	$("#city").html('');
	$.ajax({
	url:"{{route('getcitiesbystate')}}",
	type: "POST",
	data: {
	state_id: state_id,
	_token: '{{csrf_token()}}' 
	},
	dataType : 'json',
		success: function(result){
		document.getElementById("city").disabled = false;
		$('#city').html('<option value="">Select City</option>'); 
			$.each(result.cities,function(key,value){
			$("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
			});
		}
	});
});

function gethold(n)
{
	var str =n.id;
	var val = str.slice(0, -1);
	$("#vendor_id").val(val);
	
}
function accept()
{
	
	let url = "{{ route('partner.accept', ':id') }}";
	url = url.replace(':id', $("#vendorid").val());
	window.location = url

}
function reject()
{
	
	let url = "{{ route('partner.reject', ':id') }}";
	url = url.replace(':id', $("#vendorid").val());
	window.location = url

}


//image popup
function showSlides(n) {
    const img = document.getElementById("banner");
    img.onload = function () {};
    img.src = n.value;
    var slides = document.getElementsByClassName("mySlides");

    slides[0].style.display = "block";
}


</script>
@endpush