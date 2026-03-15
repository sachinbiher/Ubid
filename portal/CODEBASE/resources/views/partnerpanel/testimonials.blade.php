@extends('partnerpanel.layout')

@section('content')
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
	<div class="border bg-white">
	
		<div class="row justify-content-between mx-2 py-1 align-items-center border-bottom">
			<h3 class="mb-0"></h3>
		
					<div class="col-lg-8 col-sm-12">
						<form>
							<div class="input-group input-group-merge">
								<input type="text" class="form-control search-product" id="name" value="{{ request()->name }}" 
									placeholder="Search Name" aria-label="Search..." autocomplete='off'
									aria-describedby="categorysearch" />
								<div class="input-group-append">
									<span onclick='getsearch()' style='cursor:pointer;' class="input-group-text"><i data-feather="search"
											class="text-muted"></i></span>
								</div>		
							</div>
						</form>
					</div>
					<div class="col-lg-4 col-sm-12 float-right text-right">
							
						<div class="btn-group dropdown-sort">
							<a class="active-sorting" data-toggle="modal" data-target="#editimage" ><button type="button" class="btn btn-outline-dark  waves-effect">Request Testimonial</button></a>
						</div>

					</div>
				
	
				<!-- <div class="form-group position-relative mr-1 mb-0">
					<input type="search" class="form-control" id="basicInput" placeholder="Search" />
					<span class="search-icon"><i data-feather="search"></i></span>
				</div> -->

			
		
		</div>
		<div class="table-responsive px-2 mt-2">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Client</th>
						<th scope="col">Ratings</th>
						<th scope="col">Comments</th>
					</tr>
				</thead>
				<tbody class="text-left">
				@if(count($testimonials) >0)
				@foreach($testimonials as $testimonials)

					<tr >
						<th scope="row" width="300">
							<div class="ml-0">
								<p class="mb-0 text-dark">{{$testimonials->name}}</p>
								<p class="mb-0">Date : {{date('d M Y', strtotime($testimonials->created_at))}}</p>
							</div>
						</th>
						<td class='text-left'>
							<p class="mb-0" style='color:darkgoldenrod;font-size:18px;'>
								@php echo str_repeat("★", $testimonials->rating); @endphp
							</p>
						</td>
						<td>
							<p class="mb-0 text-left text-muted " style="word-break: break-all;">{{$testimonials->comments}}</p>
						</td>
					</tr>

				@endforeach
				@else
				<tr><td colspan='3'>No Testimonials Records</tr>
				@endif
				</tbody>
			</table>
		</div>
	</div>
	<!-- E-commerce Content Section Starts -->
	<!-- E-commerce Content Section Starts -->
	<!-- background Overlay when sidebar is shown  starts-->
	<div class="body-content-overlay"></div>
	<!-- background Overlay when sidebar is shown  ends-->

	<!-- Edit Image -->
	<div class="modal fade text-left" id="editimage" tabindexs="-3" aria-labelledby="myModalLabel4" aria-hidden="true">
		<div class="modal-dialog modal-md modal-dialog-centered" role="document">
			<div class="modal-content file-manager-application">
				<div class="modal-header">
					<h5 class="modal-title text-dark" id="myModalLabel4">Request Testimonial</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form form-horizontal " id="requesttestimonial" method="post" action="{{route('ppanel.requesttestimonial')}}" enctype="multipart/form-data" onsubmit="req_testimonial.disabled=true; return true;">
				 {!! csrf_field() !!} 
					<input type=hidden id='vendor_id' name='vendor_id'>
					
					<div class="modal-body">
						<div class="row">
							<div class="form-group col-md-12">
								<div class="form-group">
									<label for="project_img">Email Address :</label>
									<input class="form-control" type='text' required id='email' name='email' Placeholder='Enter Email Address'>
									<p>Note: In case of multiple emails, please seperate those emails by ',' without space.</p>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="form-label mr-2" for="message">Message :</label>
								<fieldset class="form-label-group">
									<textarea class="form-control" required maxlength="255" id="message" name="message" rows="5"> </textarea>
								</fieldset>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light" name="req_testimonial" id="req_testimonial"> Send Request </button>
					</div>
			</div>
			</form>
		</div>
	</div>

</div>

<script>

function getsearch(){
	var search = (document.getElementById('name').value);
	window.location.href ='{{route("ppanel.testimonials")}}?name='+search;
}


</script>
@stop