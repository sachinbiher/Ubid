@extends('partnerpanel.layout')
<style>
	.important{
		color:red;
	}
	.plusclass
	{
		border: 1px solid black;
	}

	.customcls
	{
		background-color:#151515 !important;
	}
	.main {
		display:block;
		margin:0 auto;
		}
</style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS-->
<style>
       @import "https://fonts.googleapis.com/css?family=Open+Sans:800&display=swap";


        .slider {
            display: flex;
            height: 225px;
            max-height: auto;
            overflow-y: hidden;
            overflow-x: scroll !important;
            padding: 0px 0;
            transform: scroll(calc(var(--i, 0)/var(--n)*-100%));
            scroll-behavior: smooth;
        }

        .slider::-webkit-scrollbar {
            height: 5px;
            width: 150px;
            display: none;
        }

        .slider::-webkit-scrollbar-track {
            background: transparent;
        }

        .slider::-webkit-scrollbar-thumb {
            background: #888;
        }

        .slider::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .slider img:hover {
            transform: scale(1.05);
        }

        .slide {
            position: relative;
        }

        .slide img {
            width: 200px;
            height: 200px;
            margin: 0 10px;
            object-fit: cover;
            cursor: pointer;
            transition: .25s ease-in-out;
        }

        .control-prev-btn {
            position: absolute;
            top: 50%;
            left: 3%;
           	padding:15px;
            background-color: #f8f9fa;
            width: 50px;
            border-radius: 100%;
            text-align: center;
            box-shadow: 0 1px 3px #888;
            user-select: none;
            color: #444;
            cursor: pointer;
        }

        .control-next-btn {
            position: absolute;
            top: 50%;
            right: 3%;
            padding:15px;
            background-color: #f8f9fa;
            width: 50px;
            border-radius: 100%;
            text-align: center;
            box-shadow: 0 1px 3px #888;
            user-select: none;
            color: #444;
            cursor: pointer;
        }

        .fa-long-arrow-left,.fa-long-arrow-right{
            font-size: 18px;
        }

        @media only screen and (max-width: 420px) {
            .slider {
                padding: 0;
            }

            .slide {
                padding: 16px 10px;
            }

            .slide img {
                margin: 0;
            }

            .control-prev-btn {
                top: 37%;
            }

            .control-next-btn {
                top: 37%;
            }
        }

        /* Edit and Remove Icons*/
        .edit-icon {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 15px;
            left: 26px;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
		.view-img {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 15px;
            left: 110px;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .remove-icon {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 15px;
            right: -9px;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .slide:hover img {
            opacity: 0.3;
        }
        
        .slide:hover .edit-icon,.slide:hover .remove-icon, .slide:hover .view-img {
            opacity: 1;
        }

        .icon-btn{
            border: 1px solid #151515;
            font-size: 20px;
            background:#151515;
            color: white;
            padding: 5px 10px;
        }





   </style>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
@section('content')

<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-4 col-xl-4 col-md-4 col-12">
			<div class="card card-browser-states profile-desc">
				<div class="card-body p-0">
					<!-- <span data-feather="edit" class="text-right"></span> -->
					<a class="mb-0 mt-1 mx-2 action text-dark" href='#' data-toggle="modal" data-target="#editProfile">Edit</a>
					<div
						class="profile-img-container pt-1 d-flex flex-column align-items-center mx-auto justify-content-center">
					

						<div class="profile-picture mx-auto mb-2">
								<div class="profile-img">
									@if($vendor->photo !='')
									<img src="{{$vendor->photo}}" class="round img-fluid" id='output1' alt="Card image">
									@else
									<img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" class="round img-fluid" id='output1' alt="Card image">
									@endif
								</div>
						</div>
                       
						<!-- profile title -->
						<div class="py-1 text-center">
							<p class="mb-0">{{$vendor->company }}</p>
							<!-- <b>{{$vendor->first_name }} {{$vendor->last_name }}</b> -->
							<p class="mb-0">{{$vendor->email }}</p>
							<p class="mb-0">{{$vendor->mobile }}</p>
						</div>
					</div>
					<div class="d-flex rating-section text-center">
						<div class="col-lg-4">
							<p>
								<span>0 </span>/5
								<br>
								<label>0 Ratings</label>
							</p>
						</div>
						<div class="col-lg-4">
							<p>
								<span>0</span>
								<br>
								<label>Testimonials</label>
							</p>
						</div>
						<div class="col-lg-4">
							<p>
								<span>{{$vendor->no_of_projects}}</span>
								<br>
								<label>Projects</label>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-xl-8 col-md-8 col-12">
			<div class="card ">
				<a class="mb-0 mt-1 mx-2 action text-dark" href='#' data-toggle="modal" data-target="#editaddress">Edit</a>
				<!-- <br> -->

				<div class="card-body ">
						
					<div class="row dynamic-details">
					<div class="col-lg-10 col-md-10" style='font-size:15px;'>
						@if($vendor->status == 1)
							<p class="text-success">Profile Approved : @php echo date('d M, Y',strtotime($vendor->actiondate)); @endphp</p>
						@elseif($vendor->status == 3)
							<p class="text-warning">Profile Not Activated, On Hold : {{$vendor->hold_message}} </p>
						@elseif($vendor->status == 0)
							<p class="text-danger">Profile Not Activated : Status Pending</p>
						@endif
					</div>	
						<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
							<div class="row ">
								
								<div class="col-lg-2 col-md-3 pr-0">
									<label>Address</label>
								</div>
								<div class="col-lg-10 col-md-10">
									<div class="form-group">
										<input  type="text" class="form-control" id="address" disabled="disabled"
											value="{{$vendor->address1}} {{$vendor->address2}} {{$vendor->landmark}}-{{$vendor->pincode}}." />
									</div>
								</div>
								<div class="col-lg-2 col-md-3 pr-0">
									<label>About me</label>
								</div>
								<div class="col-lg-10 col-md-10">

									<fieldset class="form-label-group">
										<textarea class="form-control"  disabled='true'  id="aboutus"
											rows="4"> {{$vendor->about_us}}</textarea>
									</fieldset>
								</div>
								<div class="col-lg-2 col-md-3 pr-0">
									<label>Services</label>
								</div>
								<div class="col-lg-10 col-md-10">
									@php $vdata = json_decode($vendor->services,TRUE);  @endphp
									@foreach($vdata as $data)
										<div class="badge badge-light-dark mr-1 mt-0">{{$data}}</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="row  dynamic-details"> </div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row justify-content-center mb-4">
		<button type="button" class="btn btn-dark mr-1">Project Details</button>
		<button type="button" class="btn btn-outline-secondary mr-1 @if($vendor->status!=1) disabled @endif">
			<a style='color:#151515;'  href="#"   data-toggle="modal" data-target="#viewdetail" onclick="changestatus(3)" >Testimonials</a></button>
		<button type="button" class="btn btn-outline-secondary mr-1 @if($vendor->status!=1) disabled @endif " >
			<a  style='color:#151515;'  @if($vendor->status==1) href="{{route('ppanel.placebids')}}" @else href="#" data-toggle="modal" data-target="#viewdetail" onclick="changestatus(1)" @endif >Place Bids</a>
		</button>
		<button type="button" class="btn btn-outline-secondary mr-1 @if($vendor->status!=1) disabled @endif " >
			<a  style='color:#151515;'  @if($vendor->status==1) href="{{route('ppanel.mybids')}}" @else href="#" data-toggle="modal" data-target="#viewdetail" onclick="changestatus(1)" @endif >My Bids</a>
		</button>
		
	</div>
	<div class="row justify-content-center pt-0">
		<div class="col-12">
			<div class="card">
				<p class="mb-0 mt-1 mx-2 font-weight-bolder">Category Details</p>
				<a class="mb-0 mt-1 mx-2 action text-dark" href='#' data-toggle="modal" onclick="cleardata()" data-target="#addproject" >Add Category</a>
				<hr />

				<div class="row ">
					@php $j=1; $projects = App\Models\Vendor_Project_info::where('vendor_ref_id',$vendor->id)->whereNull('deleted_at')->get();  @endphp
					
					@if(count($projects) > 0)
					@foreach($projects as $projects)
					<div class="col-sm-12">
						<div class="card border">
							<div class="card-header py-1">
								<!-- <div class="badge badge-secondary py-10" >Project Name : {{$projects->projectname}}</div> -->
								@php $categoryval = App\Models\Category::where('id',$projects->category)->first();
									$subcategoryval = App\Models\ChildCategory::where('id',$projects->subcategory)->where('status',1)->first();
								@endphp
									
								<div class="badge badge-secondary customcls py-10" >CATEGORY NAME : {{$categoryval->name}}</div>
								@php if($projects->subcategory !=''){ @endphp
									<div class="badge badge-secondary customcls py-10" >SUB-CATEGORY NAME :
								@php echo $subcategoryval->name; @endphp
							  </div> @php }  @endphp 

								<div >
									<i data-feather="plus" data-toggle="modal" data-target="#addimage" id="{{$projects->id}}" onclick="addimgproject(this)"  class="mr-1 icon-border"></i>
									<!-- <i data-feather="edit-3"  data-toggle="modal" data-target="#editproject" id="{{$projects->id}}" onclick="editproject(this)" class="mr-1 icon-border"></i> -->
									<i data-feather="trash-2" class="icon-border" id="{{$projects->id}}" onclick="deleteproject(this)" ></i>
								</div>
							</div>
							
							<div class="card-body text-center">
								<div class="container">
									<div id="slider-container{{$j}}" class="slider">
						
										@if($projects->images != '')
											@php $da = json_decode($projects->images,TRUE); $i=0; @endphp
											@foreach($da as $img)
													
												<div class="slide">
													<img src="{{$img['name']}}" class="plusclass" alt="">
													<!-- <div style='width:200px; margin: 0 10px;'>{{$img['description']}}</div> -->
													<div class="edit-icon">
														<button class="icon-btn" title="edit"  data-toggle="modal" data-target="#editimage" id="{{$projects->id.','.$i}}" onclick="editimgproject(this)" >
															<span><i class="fa fa-edit" ></i></span>
														</button>
													</div>
													<div class="view-img">
														<button class="icon-btn" title="view"  id="{{$projects->id.','.$i}}" data-toggle="modal" data-target="#imgmyModal" onclick="showSlides(this)"  >
															<span><i class="fa fa-eye" ></i></span>
														</button>
													</div>
													<div class="remove-icon">
														<button class="icon-btn" title="delete">
															<span><i class="fa fa-trash-o" id="{{$projects->id.','.$i}}" onclick="deleteprojectimg(this)"></i></span>
														</button>
													</div>
												</div>
											@php $i++; @endphp
											@endforeach
										@else
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
											
										@endif
											<div class="control-prev-btn" onclick="prev({{$j}})">
												<i class="fa fa-long-arrow-left"></i>
											</div>
											<div class="control-next-btn" onclick="next({{$j}})">
												<i class="fa fa-long-arrow-right"></i>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					@php $j++; @endphp		
					@endforeach
					@endif
					
					@php $deleted =  json_decode($vendor->deleted_services,TRUE); @endphp
					@php $categories = App\Models\Category::where('status',1)->whereNull('deleted_at')->orderby('name','asc')->get(); @endphp	
					
					
					
					@foreach($categories as $cate)
					@if(in_array($cate->name,$vdata))
					@if(!in_array($cate->id,$deleted))
					
					<div class="col-sm-12">
						<div class="card border">
							<div class="card-header py-1">
								
								<div class="badge badge-secondary customcls py-10" >CATEGORY NAME : {{$cate->name}} </div>
								<div>
									@if(in_array($cate->name,$vdata))
										<i data-feather="upload" data-toggle="modal" title="Upload Images" data-target="#uploadimage" id="{{$cate->id}}" onclick="uploadimg(this)"
											  class="mr-1 icon-border"></i>
									@else
										<i data-feather="upload" data-toggle="modal" title="Upload Images" data-target="#viewdetail"  onclick="changestatus(2)"
											  class="mr-1 icon-border"></i>
									@endif
										<i data-feather="trash-2" class="icon-border" title="Delete Category" id="{{$cate->id}}" onclick="deletecategory(this)" ></i>
								</div>
							</div>
							
							<div class="card-body text-center">
								<div class="container">
									<div id="slider-container{{$j}}" class="slider">
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="slide"><img src="{{url('partner-assets/app-assets/images/pages/Plus_symbol.svg')}}"  class="plusclass" alt="No Image" width="200" height="200" /></div>
										<div class="control-prev-btn" onclick="prev({{$j}})">
											<i class="fa fa-long-arrow-left"></i>
										</div>
										<div class="control-next-btn" onclick="next({{$j}})">
											<i class="fa fa-long-arrow-right"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					@endif
					@endif
					@endforeach
					
					
								
					
				
				</div>
			</div>
		</div>
	</div>
	<!-- E-commerce Content Section Starts -->
	<!-- E-commerce Content Section Starts -->
	<!-- background Overlay when sidebar is shown  starts-->
	<div class="body-content-overlay"></div>
	<!-- background Overlay when sidebar is shown  ends-->
</div>

<!-- Edit Basic Data -->
<div class="modal fade text-left" id="editProfile" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel1">Basic Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form form-horizontal " id="basic-save" method="post" action="{{route('ppanel.updatebasicdetail')}}" enctype="multipart/form-data">
			{!! csrf_field() !!}
				<div class="modal-body ">
					<div class="row">
						<div class="col-12">
							<div class="profile-picture mx-auto mb-2">
								<div class="profile-img">
									@if($vendor->photo !='')
									<img src="{{$vendor->photo}}" class="round img-fluid" id='output' alt="Card image">
									@else
									<img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" class="round img-fluid" id='output' alt="Card image">
									@endif
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group row">	
								<div class="col-sm-3 col-form-label">
									<label>Profile Image<span class="required important"> * </span></label>
								</div>
								<div class="col-sm-9">
									 <input class='custom-file-input' id='profileimg' name='profileimg' type="file" accept="application/pdf,image/jpeg,image/png"  onchange="loadFile(event)">
									 <label class="custom-file-label" for="profileimg">Choose file</label>								
								</div>
							</div>	
						</div>
						<div class="col-12">
							<div class="form-group row">
								<div class="col-sm-3 col-form-label">
									<label>Name<span class="required important"> * </span></label>
								</div>
								<div class="col-sm-9">
										<input type="text" required class="form-control" id="company" name="company"
											placeholder=" Name" value="{{$vendor->company}}" autocomplete="off" />
										<span class="highlight">{{$errors->first('company')}}</span>
								</div>
							</div>
						</div>

						<!-- <div class="col-12">
							<div class="form-group row">
								<div class="col-sm-3 col-form-label">
									<label>First Name<span class="required important"> * </span></label>
								</div>
								<div class="col-sm-9">
										<input type="text"  class="form-control" id="fname" name="fname"
											placeholder="First Name" value="{{$vendor->first_name}}" autocomplete="off" />
										<span class="highlight">{{$errors->first('fname')}}</span>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group row">
								<div class="col-sm-3 col-form-label">
									<label>Last Name<span class="required important"> * </span></label>
								</div>
								<div class="col-sm-9">
									<div class="form-contorl">
										
										<input type="text" id="lname" class="form-control" name="lname"
											placeholder="Last Name" value="{{$vendor->last_name}}" autocomplete="off" />
											<span class="highlight">{{$errors->first('lname')}}</span>
									</div>
								</div>
							</div>
						</div> -->
						<div class="col-12">
							<div class="form-group row">
								<div class="col-sm-3 col-form-label">
									<label>Email<span class="required important"> * </span></label>
								</div>
								<div class="col-sm-9">
									<input type="email" id="email" class="form-control" name="email"
											placeholder="Email" disabled='true' value="{{$vendor->email}}"/>
											<span class="highlight">{{$errors->first('email')}}</span>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group row">
								<div class="col-sm-3 col-form-label">
									<label>Mobile<span class="required important"> * </span></label>
								</div>
								<div class="col-sm-9">
									<input type="number" disabled="true" id="contact-icon" class="form-control" name="contact-icon"
											placeholder="Mobile" value='{{$vendor->mobile}}' />
											<span class="highlight">{{$errors->first('contact-icon')}}</span>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group row">
								<div class="col-sm-3 col-form-label">
									<label>No of Projects<span class="required important"> * </span></label>
								</div>
								<div class="col-sm-9">
									<input type="number" required id="noofprojects" class="form-control" name="noofprojects"
											placeholder="No of Projects" value='{{$vendor->no_of_projects}}' />
											<span class="highlight">{{$errors->first('noofprojects')}}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-Success waves-effect waves-float waves-light" name="savebasic" id="savebasic"
						data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." >
						Update
					</button>	      
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Address Data -->
<div class="modal fade text-left" id="editaddress" tabindexs="-2" aria-labelledby="myModalLabel2" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel2">Additional Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form form-horizontal " id="addi-save" method="post" action="{{route('ppanel.updateadditionaldetail')}}" enctype="multipart/form-data">
					{!! csrf_field() !!}
				<div class="modal-body " >
					<div class="row">
                          
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="address1">Address Line 1 :<span class="required important"> * </span></label>
                                <input type="text" required id="address1" value="{{$vendor->address1}}" name="address1" class="form-control" autocomplete="off" placeholder="" />
                                <span class="highlight">{{$errors->first('address1')}}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="address2">Address Line 2 :</label>
                                <input type="text" id="address2" value="{{$vendor->address2}}" name="address2"class="form-control" placeholder="" />
                                <span class="highlight">{{$errors->first('address2')}}</span>
                            </div>
						

							

							@php $states = \App\Models\State::get(); @endphp
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="state">State :<span class="required important"> * </span></label>
                                <select class="form-control" onchange="changestate()" required name="state" id="state">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
										@if($vendor->state_id == $state->id)
											<option value="{{$state->id}}" selected>{{$state->name}}</option>
										@endif
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                                <span class="highlight">{{$errors->first('state')}}</span>
                            </div>

							@php $cities = \App\Models\Cities::where('id',$vendor->city)->first(); @endphp
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="city">City :<span class="required important"> * </span></label>
                                <select class="form-control" name="city" id="city" required >
									
									<option value="{{$cities->id}}" selected>{{$cities->name}}</option>
										
                                </select>
                                <span class="highlight">{{$errors->first('city')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="pincode">Pincode :<span class="required important"> * </span></label>
                                <input type="number" id="pincode" required value="{{$vendor->pincode}}" name="pincode" class="form-control" placeholder="" />
                                <span class="highlight">{{$errors->first('pincode')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="landmark">Landmark :</label>
                                <input type="text" id="landmark" value="{{$vendor->landmark}}" name="landmark" class="form-control" placeholder="" />
                                <span class="highlight">{{$errors->first('landmark')}}</span>
                            </div>
							
							<div class="form-group col-md-12">
								<label class="form-label mr-2" for="aboutus">About Me :</label>
								<fieldset class="form-label-group">
										<textarea class="form-control"  id="aboutus" maxlength = "255" name="aboutus"
											rows="5"> {{$vendor->about_us}}</textarea>
									</fieldset>
									<span class="highlight">{{$errors->first('aboutus')}}</span>
							</div>
							<div class="form-group col-md-12">
								<label class="form-label mr-2" for="category">Services :<span class="required important"> * </span></label>
								<select  class="floating-select select2 form-control form-control dt-input dt-full-name"
									data-column="1" placeholder="Primary Category" required data-column-index="0" multiple id="category" name="category[]">
									<option value="">Select Category</option>
									@foreach($categories as $category)
										@if(in_array($category->name,$vdata))
										<option value="{{$category->name}}" selected>{{$category->name}}</option>
										@else
                                        <option value="{{$category->name}}">{{$category->name}}</option>
										@endif
									@endforeach
								</select> 
							</div>				
                    </div>
				</div>
				<div class="modal-footer">
	
					<button type="submit" class="btn btn-Success waves-effect waves-float waves-light" name="saveaddi" id="saveaddi"
						data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">
						Update
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Add Category -->
<div class="modal fade text-left" id="addproject" tabindexs="-3" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-secondary" id="myModalLabel3">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form form-horizontal " id="project-save" method="post" action="{{route('ppanel.addcategory')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="modal-body " >
					<div class="row">
						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="categoryserve">Category :<span class="required important"> * </span></label>
							<select  class=" form-control" onchange='getsubcategories()'
								 placeholder="Primary Category"  id="categoryserve" name="categoryserve">
								<option value="">Select Category</option>

								@foreach($categories as $category)
									
										<option value="{{$category->id}}">{{$category->name}}</option>
								@endforeach
							</select> 
							<span class="highlight">{{$errors->first('categoryserve')}}</span>

						</div>
						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="subcategoryserve">Sub-Category :</label>
							<select  class=" form-control"
								data-column="1" placeholder="Primary Sub  Category" data-column-index="0"  id="subcategoryserve" name="subcategoryserve">
								<option value="">Select Sub-Category</option>
								<!-- <option value="1">Category</option> -->

							</select> 
							<span class="highlight">{{$errors->first('subcategoryserve')}}</span>

						</div>
						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="projectname">Project Name :</label>
							<input type="text" id="projectname" class="form-control" name="projectname"
											placeholder="Enter Project Name"  />
											<span class="highlight">{{$errors->first('projectname')}}</span>
						</div>
										
                     </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success waves-effect waves-float waves-light" name="saveproject" id="saveproject"
						data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." >
						Save
					</button>	
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Add Images -->
<div class="modal fade text-left" id="addimage" tabindexs="-3" aria-labelledby="myModalLabel4" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel4">Add Images</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form form-horizontal " id="project-saveimg" method="post" action="{{route('ppanel.addprojectimage')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type=hidden id='category' name='category' >
				<input type=hidden id='subcategory' name='subcategory' >
				<input type=hidden id='vendor_id' name='vendor_id' >
				<input type=hidden id='projectid' name='projectid'>
				<div class="modal-body" >
					<div class="row">
						<div class="form-group col-md-12">
							<div class="form-group">
								<label for="project_img">Upload Images :<span class="required important"> * </span></label>
								<div class="custom-file">
									<input type="file" accept="application/pdf,image/jpeg,image/png" required multiple="multiple"  class="custom-file-input" id="project_img" name="project_img[]" />
									<label class="custom-file-label" for="customFile">Choose file</label>
									<span class="highlight">{{$errors->first('project_img')}}</span>	
								</div>
							</div>
						</div>

						
                     </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-Success waves-effect waves-float waves-light" name="saveprojectimg" id="saveprojectimg"
						data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." >
						Save
					</button>	
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Edit Image -->
<div class="modal fade text-left" id="editimage" tabindexs="-3" aria-labelledby="myModalLabel4" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel4">Edit Image</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form form-horizontal " id="project-editimg" method="post" action="{{route('ppanel.updateprojectimage')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type=hidden id='project_id' name='project_id'>
				<input type=hidden id='imageid' name='imageid'>
				
				<div class="modal-body" >
					<div class="row">
						<div class="form-group col-md-12">
							<div class="form-group">
								<label for="project_img">Upload Images :</label>
								<div class="custom-file">
									<input type="file" accept="application/pdf,image/jpeg,image/png" class="custom-file-input" id="project_img_update" name="project_img_update" />
									<label class="custom-file-label" for="customFile">Choose file</label>
									<span class="highlight">{{$errors->first('project_img_update')}}</span>	
								</div>
							</div>
						</div>

						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="description">Description :</label>
							<fieldset class="form-label-group">
									<textarea class="form-control" maxlength = "255"  id="description" name="description"
										rows="5"> </textarea>
								</fieldset>
						</div>
                     </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-Success waves-effect waves-float waves-light" name="editimg" id="editimg"
						data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." >
						Update
					</button>	
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Upload Images -->
<div class="modal fade text-left" id="uploadimage" tabindexs="-3" aria-labelledby="myModalLabel5" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel5">Upload Images</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form form-horizontal " id="project-uploadimg" method="post" action="{{route('ppanel.uploadprojectimage')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type=hidden id='categoryid' name='categoryid' >
				
				<!-- <input type=hidden id='vendor_id' name='vendor_id' > -->
				<!-- <input type=hidden id='projectid' name='projectid'> -->
				<div class="modal-body" >
					<div class="row">
					<div class="form-group col-md-12">
							<label class="form-label mr-2" for="childcategory">Sub-Category :</label>
							<select  class=" form-control"
								data-column="1" placeholder="Primary Sub  Category" data-column-index="0"  id="childcategory" name="childcategory">
								<option value="">Select Sub-Category</option>
								<!-- <option value="1">Category</option> -->
							</select> 
							<span class="highlight">{{$errors->first('childcategory')}}</span>

						</div>
			
						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="projectname1">Project Name :</label>
							<input type="text" id="projectname1" class="form-control" name="projectname1"
											placeholder="Enter Project Name"  />
											<span class="highlight">{{$errors->first('projectname1')}}</span>
						</div>
						<div class="form-group col-md-12">
							<div class="form-group">
								<label for="project_img">Upload Images :<span class="required important"> * </span></label>
								<div class="custom-file">
									<input type="file" accept="application/pdf,image/jpeg,image/png" required multiple="multiple"  class="custom-file-input" id="project_img_u" name="project_img_u[]" />
									<label class="custom-file-label" for="customFile">Choose file</label>
									<span class="highlight">{{$errors->first('project_img')}}</span>	
								</div>
							</div>
						</div>
						
                     </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-Success waves-effect waves-float waves-light" name="uploadprojectimg" id="uploadprojectimg"
						data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." >
						Upload
					</button>	
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Edit Project -->
<div class="modal fade text-left" id="editproject" tabindexs="-4" aria-labelledby="myModalLabel6" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel6">Edit Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
				<form class="form form-horizontal">
					<div class="row">
						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="editcategoryserve">Category :<span class="required important"> * </span></label>
							<select  class=" form-control"id="editcategoryserve" name="editcategoryserve">
								<option value="">Select Category</option>
					            @foreach($categories as $category)
					            @if(in_array($category->name,$vdata))
									<option value="{{$category->id}}">{{$category->name}}</option>
								@endif
								@endforeach
							</select> 
						</div>
						
						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="editsubcategoryserve">Sub-Category :</label>
							<select  class=" form-control"
								data-column="1" placeholder="Primary Sub  Category" data-column-index="0"  id="editsubcategoryserve" name="editsubcategoryserve">
								<option value="">Select Sub-Category</option>
								<!-- <option value="1">Category</option> -->

							</select> 
							<span class="highlight">{{$errors->first('editsubcategoryserve')}}</span>

						</div>
						<div class="form-group col-md-12">
							<label class="form-label mr-2" for="editprojectname">Project Name :</label>
							<input type="text" id="editprojectname" class="form-control" name="editprojectname"
											placeholder="Enter Project Name" value="" />
											<span class="highlight">{{$errors->first('projectname')}}</span>
						</div>

						<!-- <div class="form-group col-md-12">
							<label class="form-label mr-2" for="editprojectimages">Images :</label>
							<div id='imagesdiv'>
							</div>
						</div>
						 -->
								
                     </div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-Success waves-effect waves-float waves-light" (click)="modal.close('Accept click')" rippleEffect>
					Update
				</button>
			</div>
		</div>
	</div>
</div>
<!-- View Status -->
<div class="modal fade text-left" id="viewdetail" tabindex="-1" role="dialog" aria-labelledby="viewdetailLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered"  role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h4 class="modal-title text-dark" id="viewdetailLabel">Profile Status</h4>
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
				 <!-- <Label id='descriptionval'></label> -->
               </div>
			   <br>
			   <div class='col-md-12' >
			  	 <b>Description: </b><br>
				
				 <div class="modal-body p-2" id='descriptionval' style="word-break: break-all;"></div>
               </div>

         </div>
		</div>
	</div>
</div>



<script>

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };


//image popup
function showSlides(n) {

	$.ajax({
		method:'get',
		url: '{{route("ppanel.getprojectimages")}}',
		data: {'projectid' : n.id},
		success: function(data) {
			// console.log(data.imgdata.description);
			// $('#project_id').val(data.projectid)
			// $('#imageid').val(data.imageid)
			// $('#description').val(data.imgdata.description)

			const img = document.getElementById("banner");
			img.onload = function () {};
			img.src = data.imgdata.name;
			var slides = document.getElementsByClassName("mySlides");

			slides[0].style.display = "block";
			$("#descriptionval").html(data.imgdata.description);
			
			}
		
		});

}




  function getsubcategories(){
	var category = $("#categoryserve").val();
	
	$.ajax({
		method:'get',
		url: '{{route("ppanel.getsubcategories")}}',
		data: {'category' : category},
		success: function(data) {
			var select = document.getElementById("subcategoryserve");
			select.options[0] = new Option("Select Sub-Category", '');
		
			for($i=0;$i<data.length;$i++) {
   			 select.options[$i+2] = new Option(data[$i].name, data[$i].id);
			}
		}
	});

}



function cleardata() {
 // executes when HTML-Document is loaded and DOM is ready
	$("#subcategoryserve").val("");
	$("#categoryserve").val("");
	
}
// $('.custom-file-input').on('change', function(e) {
//     var extension = e.target.files[0].name.split('.').pop().toLowerCase()
//     var reader = new FileReader();
//     reader.onload = function(e) {
//         if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'pdf') {
//             $('#profileimg').attr('src', reader.result);
//         }
//         else{
//             alert('Allowed Extensions are : *.jpg ,*.jpeg ,*.png ,*.pdf')
//             $('#profileimg').attr('src', 'partner-assets/app-assets/images/avatars/profile.png');
            
//         }
//     }
//     reader.readAsDataURL(e.target.files[0]);
// });

function changestate()
{
	var state_id = $("#state").val(); 
	
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
		document.getElementById("city").readonly = false;
		$('#city').html('<option value="">Select City</option>'); 
			$.each(result.cities,function(key,value){
			$("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
			});
		}
	});
}




function uploadimg(n)
{
	
	$.ajax({
		method:'get',
		url: '{{route("ppanel.uploadproject")}}',
		data: {'projectid' : n.id},
		success: function(data) {
			
			$("#categoryid").val(data.category[0].id);
			$("#categoryid").val();
			var select = document.getElementById("childcategory");
			select.options[0] = new Option("Select Sub-Category", '');
			for($i=0;$i<data.child.length;$i++) {
   			 select.options[$i+1] = new Option(data.child[$i].name, data.child[$i].id);
			}

		}
		
	});

}	
function addimgproject(n)
{
	
	$.ajax({
		method:'get',
		url: '{{route("ppanel.getprojectdetails")}}',
		data: {'projectid' : n.id},
		success: function(data) {
			$("#category").val(data[0].category)
			$("#subcategory").val(data[0].subcategory)
			$("#vendor_id").val(data[0].vendor_ref_id)
			$('#projectid').val(data[0].id)
			}
		
		});
}

function editimgproject(n)
{
	
	$.ajax({
		method:'get',
		url: '{{route("ppanel.getprojectimages")}}',
		data: {'projectid' : n.id},
		success: function(data) {
			console.log(data.imgdata.description);
			$('#project_id').val(data.projectid)
			$('#imageid').val(data.imageid)
			$('#description').val(data.imgdata.description)
			
			}
		
		});
}

function deleteprojectimg(n)
{
	// alert(n.id);
	var id='#'+n.id;

	var $this = $(this);

	let url = "{{ route('ppanel.deleteprojectimage', ':id') }}";
	url = url.replace(':id', n.id);
	Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			showClass: {
				popup: 'animate__animated animate__fadeIn'
			},
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-outline-danger ml-1'
			},
			buttonsStyling:delete false
		}).then(function(result) {
			if (result.value) {
				window.location = url;
			}
	});

}

function editproject(n)
	{
		$.ajax({
		method:'get',
		url: '{{route("ppanel.getprojectdetails")}}',
		data: {'projectid' : n.id},
		success: function(data) {
				
			$("#editcategoryserve").val(data[0].category);
			$("#editcategoryserve").trigger('change'); 
			$("#editsubcategoryserve").val(data[0].subcategory);
			$("#editsubcategoryserve").trigger('change'); 
			$("#editprojectname").val(data[0].projectname)
			$("#vendor_id").val(data[0].vendor_ref_id)
			
			
			const myArr = data[0].images.split(",");
			
			var text='';
			for(i=0;i<myArr.length;i++)
			{
				text +='<img src='+myArr[i]+'  class="plusclass" alt="No Image" width="200" height="200" />'
			}

			$("#imagesdiv").html( text );

			}
		
		});
	}

function deleteproject(n)
{
	var id='#'+n.id;

    var $this = $(this);
	
	let url = "{{ route('ppanel.deleteproject', ':id') }}";
	url = url.replace(':id', n.id);
	Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			showClass: {
				popup: 'animate__animated animate__fadeIn'
			},
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-outline-danger ml-1'
			},
			buttonsStyling:delete false
		}).then(function(result) {
			if (result.value) {
				window.location = url;
			}
	});

}

function deletecategory(n)
{
	var id='#'+n.id;

    var $this = $(this);
	
	let url = "{{ route('ppanel.deletecategory', ':id') }}";
	url = url.replace(':id', n.id);
	Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			showClass: {
				popup: 'animate__animated animate__fadeIn'
			},
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-outline-danger ml-1'
			},
			buttonsStyling:delete false
		}).then(function(result) {
			if (result.value) {
				window.location = url;
			}
	});

}
</script>
<script >
        function prev(i) {
            document.getElementById('slider-container'+i).scrollLeft -= 270;
        }

        function next(i) {
            document.getElementById('slider-container'+i).scrollLeft += 270;
        }
    </script>
@stop

@push('PAGE_ASSETS_JS')
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Category = function () {
      return { //main function to initiate the module
         init: function () {
			
		}
   }   
}();

jQuery(document).ready(function() {
   Category.init();
});

$('.carousel').slick({
	dots: false,
	infinite: false,
	speed: 300,
	slidesToShow: 6,
	slidesToScroll: 3,
	responsive: [
		{
		breakpoint: 1024,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 3,
			infinite: true,
			dots: true
		}
		},
		{
		breakpoint: 600,
		settings: {
			slidesToShow: 2,
			slidesToScroll: 2
		}
		},
		{
		breakpoint: 480,
		settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		}
		}
		// You can unslick at a given breakpoint now by adding:
		// settings: "unslick"
		// instead of a settings object
	]
});

</script>

    <!-- Bootstrap JS -->
    
@endpush