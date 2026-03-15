@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
<style>
   .dt-button{
      display:none !important;
   }
</style>
@endpush

@section('content')
<div class="">
   <div class="content-overlay"></div>
   <div class="header-navbar-shadow"></div>
   <div class="content-wrapper">
      <div class="content-body">
         <section class="parent-productlist advanced-search-datatable"><!-- 
            <ul class="nav nav-pills tabs-pages tab-leftside">
               <li class="nav-item">
                  <a class="nav-link active" href="manage-certificates.html"> <span class="bs-stepper-box">
                  <i data-feather="package" class="font-medium-3"></i>
                  </span>Manage Certificates</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="current-membership.html"> <span class="bs-stepper-box">
                  <i class="fal fa-cog" class="font-medium-3"></i>
                  </span>Current Membership</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link " href="rejoining-list.html"><span class="bs-stepper-box">
                  <i class="fal fa-tag" class="font-medium-3"></i>
                  </span>Rejoining List</a>
               </li>
            </ul> -->
            <div class="col-12 mt-5">
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
                                       <label>Name</label>
                                       <input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="Name" name="fname" id="fname" value="{{request()->fname}}"/> </div>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                       <label>Email ID</label>
                                       <input type="text" class="form-control dt-input dt-email" data-column="5" placeholder="Email ID" name="femail" id="femail"value="{{request()->femail}}" /> </div>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                       <label>Contact No.</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" data-column="5" placeholder="Contact No." name="fmobile" id="fmobile" value="{{request()->fmobile}}"/> </div>
                                 </div>
                                    <div class="col-4">
                                       <div class="form-group">
                                          <label>Status</label>
                                          <div class="w-100">
                                             <div class="floating-label">
                                                <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="" name="fstatus" id="fstatus">
                                                <option value="">Select</option>   
                                                <option value="1"{{request()->fstatus=='1'?'selected="selected"':''}}>Active</option>
                                                   <option value="0"{{request()->fstatus=='0'?'selected="selected"':''}}> In-active </option>
                                                </select>
                                                <span class="highlight"></span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                       <label>Customer ID</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" data-column="5" placeholder="Customer ID No."name="fcustomer" id="fcustomer"/> </div>
                                 </div>
                                 <div class="col-4">
                                       <div class="form-row mt-2">
                                          <button type="button" class="btn btn-primary mr-1" id="dt-feature-filter-form-search"><i class="fal fa-search"></i></button>
                                          <a href="{{route('customer')}}" class="btn btn-outline-secondary"><i class="fal fa-redo"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="card basic-datatable table-fixedheader datatable-list">
                              <table class="dt-customers table table-bordered table-responsive">
                                 <thead>
                                    <tr>
                                          <th>Customer id</th>
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
            </div>
         </section>
      </div>
   </div>
</div>
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

<!-- Add Edit Customer Modal-->
<div class="modal fade text-left" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered" role="document"></div></div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Customer = function () {
      return { //main function to initiate the module
         init: function () {

            var dt_ajax_table = $('.dt-customers');
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
                        searchPlaceholder: 'Search using Customer ID ',
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    },
                });

                $('body').on('switchChange.bootstrapSwitch', '.status-switch', function(event, state){
                var switchControl = $(this);
                var stateText = (state)?'Activate':'Deactivate';
                swal({
                    title: 'Are you sure?',
                    text: 'Are you sure? You want '+stateText+' this data.',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-success',
                    cancelButtonClass: 'btn-danger',
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                },
                function(isConfirm){
                    if (isConfirm){
                        $.ajax({
                            url: "{{route('customer.changeStatus')}}", 
                            type:'post',
                            data: {table:'customers',id:switchControl.val(),status:state, _token: '{{csrf_token()}}'},
                            success: function(result){
                                swal('Customers', 'Status has been '+stateText+'d', "success");
                            }
                        });
                    }
                    else {
                        switchControl.bootstrapSwitch('state', !state);
                    }
                });
            });

                  $('.dt-customers').on('click', '.delete-record', function() {
                        var $this = $(this);

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
                                 confirmButton: 'btn btn-primary',
                                 cancelButton: 'btn btn-outline-danger ml-1'
                              },
                              buttonsStyling: false
                        }).then(function(result) {
                              if (result.value) {
                                 window.location = $this.attr('del-url');
                              }
                        });
                     });
               }   

            // Modal form submit start
            $('body').on('click', '#save', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $('form.customer-update').attr('action'),
                    data: $('form.customer-update').serialize(),
                    datatype: JSON,
                    success: function(response) {
                        if(response.status == 'validations') {
                            $.each(response.errors, function (key, error) {
                                $('form.customer-update').find("#" + key).removeClass('error').addClass('error');
                                $('form.customer-update').find("#" + key + "-error").text(error[0]);
                            });
                        }

                        if(response.status == 'success') {
                            window.location = "{{route('customer')}}"
                        }

                        if(response.status == 'error') {
                            JsUtility.showToastr('error', 'Customer', response.message);
                        }
                    },
                    error: function() {
                        JsUtility.showToastr('error', 'Customer', response.message);
                    }
                });
                return false;
            });
            
            //filtering
            $('body').on('click', '#dt-feature-filter-form-search', function(e) {
                e.preventDefault();
                var url = "{{route('customer')}}?search=1";
                if($('#fname').val() != '') url += "&fname="+encodeURIComponent($('#fname').val());
                if($('#femail').val() != '') url += "&femail="+encodeURIComponent($('#femail').val());
                if($('#fmobile').val() != '') url += "&fmobile="+encodeURIComponent($('#fmobile').val());
                if($('#fcustomer').val() != '') url += "&fcustomer="+encodeURIComponent($('#fcustomer').val());
                if($('#fstatus').val() != '') url += "&fstatus="+encodeURIComponent($('#fstatus').val());
               //  alert(url);
                window.location.href = url;

            });

            $(window).on('load', function() {
               if (feather) {
                  feather.replace({
                        width: 14,
                        height: 14
                  });
               }
            });
      }
   }   
}();

jQuery(document).ready(function() {
   Customer.init();
});
</script>
@endpush