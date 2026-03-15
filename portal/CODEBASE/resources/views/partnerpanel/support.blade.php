@extends('partnerpanel.layout')

@section('content')
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">

	<section>
		<div class="row v-row justify-content-center pb-4">
			<div class="col-sm-5 p-sm-5">
				<h1 class="font-weight-bolder" style="font-size: 46px;">Get In touch!</h1>
				<p style="font-size: 18px;">We'd love to hear from you. Here's how you can reach us.
				</p>
			</div>
			<div class="col-md-5 text-center" >
				<span class="contact-box-item number desktop">
					<button class="btn btn-danger raiseTicket mb-2" data-toggle="modal" data-target="#modalTicket">
					<i data-feather="tag"></i> Submit a ticket
					</button>
				</span>
			</div>
		</div>
	</section>
	<section class="bg-white p-2">
		<div class="row justify-content-center">
			<div class="col-lg-5 col-sm-12  col-xs-12">
				<div class="card p-4 text-center custom-card">
					<img class="contact-box-item mx-auto" src="http://cdn.onlinewebfonts.com/svg/img_503524.png" width="50">
					<span class="contact-box-item title">Talk to Support</span>
					<span class="contact-box-item blurb">You can drop us an email- <a href="mailto:contact@ubidindia.com">contact@ubidindia.com</a> or call us on.</span>
					<span class="contact-box-item number desktop">
					<a href="tel:+911171279211" class="hsg-sales-number hsg-nav__link" data-sales-number="local"
						data-invoca-number="1 877 929 0687" aria-hidden="false" data-loaded="true" style="">
					<span class="hsg-nav__link-label hsg-nav__link-label--phone">
					<!--<span class="hsg-sales-number__number">+91 80728 86122</span>-->
					</span>
					</a>
					</span>
				</div>
			</div>
			
			<!-- <div class="col-5">
				<div class="card p-4 text-center custom-card">
					<img class="contact-box-item mx-auto"
						src="data:image/png;base64,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" width="50">
					<span class="contact-box-item title">Contact Customer Support</span>
					<span class="contact-box-item blurb"> Need some help? Chat with us, we're always happy to
					help.</span>
					
				</div>
			</div> -->
		</div>
	</section>
	<section class="bg-white pb-5">
		<div class="border bg-white mx-2">
			<div class="row justify-content-between mx-2 py-1 align-items-center border-bottom">
				<h3 class="mb-0">Tickets</h3>
			</div>
			<div class="table-responsive px-2 mt-2">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Ticket Id</th>
							<th scope="col">Title</th>
							<th scope="col">Issue</th>
							<th scope="col">Status</th>
							<th scope="col">Created On</th>
							<th scope="col">Remarks</th>
						</tr>
					</thead>
					<tbody>
					
						@if(isset($tickets))
						@foreach($tickets as $ticket)
						<!-- href="{{route('ppanel.conversation',['id'=>$ticket->id])}}" -->
						<tr scope="row">
							<th width="10%" >
								<p class="mb-0">{{$ticket->ticket_id}}</p>
							</th>
							<th width="20%" >
								<p class="mb-0" style="word-wrap: break-word;">{{$ticket->issue_title}}</p>
							</th>
							<th width="30%" >
								<p class="mb-0" style="word-wrap: break-word;">{{$ticket->issue}}</p>
							</th>
							<th width="5%" >
							@if($ticket->status==0)
							<div class="badge badge-pill badge-light-danger">Open</div>
							@elseif($ticket->status==1)
							<div class="badge badge-pill badge-light-success">Resolved</div>
							@else
							<div class="badge badge-pill badge-light-danger">Re-Open</div>
							@endif
							</th>
							<th width="15%" >
								<p class="mb-0">{{date('d M Y', strtotime($ticket->created_at))}}</p>
							</th>
							<th width="20%" >
								@if($ticket->status==1)
								<p class="mb-0" style="word-wrap: break-word;">{{$ticket->remark}}</p>
								@else
								<p class="mb-0">-</p>
								@endif
							</th>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<!-- E-commerce Content Section Starts -->
	<!-- E-commerce Content Section Starts -->
	<!-- background Overlay when sidebar is shown  starts-->
	<div class="body-content-overlay"></div>
	<!-- background Overlay when sidebar is shown  ends-->
</div>


<!-- Raise A Ticket -->
<div class="modal fade text-left" id="modalTicket" tabindexs="-4" aria-labelledby="myModalLabel6" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel6">Ticket Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
			<form class="form form-vertical" id="vendorRaiseTicket" action="{{route('ppanel.vendorRaiseTicket')}}" method="post" enctype="multipart/form-data" onsubmit="save.disabled=true; return true;">
			{!! csrf_field() !!}
				<div class="modal-body" tabindex="0">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="first-name-vertical">Title</label>
									<input type="text" id="first-name-vertical" class="form-control" name="title" id="title" required/>
								</div>
							</div>
							@php $ticketcategories = \App\Models\Ticketing_Category::where('status','1')->whereNull('deleted_at')->get(); @endphp 
							<div class="col-12">
								<div class="form-group">
									<label for="email-id-vertical">Category</label>
									<select class="form-control" id="basicSelect category" name="category" id="category" required>
										<option value="">Select</option>
										@foreach($ticketcategories as $categories)
										<option value="{{$categories->id}}">{{$categories->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="contact-info-vertical">Description</label>
									<fieldset class="form-label-group mb-0">
										<textarea class="form-control char-textarea" name="description"
											id="textarea-counter" maxlength="255" rows="3" required></textarea>
									</fieldset>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="password-vertical">Upload Images</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="customFile" />
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="save" id="save" value="save" class="btn btn-danger">
						Submit
					</button>
				</div>
			</form>
			</div>
			
		</div>
	</div>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Customer = function () {
      return { //main function to initiate the module
         init: function () {
			$('.raiseTicket').on('click', function() {
				$('#modalTicket').modal('show');
			});

			//Modal form submit start
            $('body').on('click', '#save', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $('form.vendorRaiseTicket').attr('action'),
                    data: $('form.vendorRaiseTicket').serialize(),
                    datatype: JSON,
                    success: function(response) {
                        if(response.status == 'validations') {
                            $.each(response.errors, function (key, error) {
                                $('form.vendorRaiseTicket').find("#" + key).removeClass('error').addClass('error');
                                $('form.vendorRaiseTicket').find("#" + key + "-error").text(error[0]);
                            });
                        }

                        if(response.status == 'success') {
                            window.location = "{{route('ppanel.support')}}"
                        }

                        if(response.status == 'error') {
                            JsUtility.showToastr('error', 'Ticket', response.message);
                        }
                    },
                    error: function() {
                        JsUtility.showToastr('error', 'Ticket', response.message);
                    }
                });
                return false;
            });

      }
   }   
}();

jQuery(document).ready(function() {
   Customer.init();
});
</script>
@endpush
