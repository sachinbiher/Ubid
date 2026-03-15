@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
<style>
	.dt-button{
		display:none;
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

         @include('subscription.tabs')

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
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>User Id</label>
                                       <input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="User Id" name="fuser" id="fuser" value="{{request()->fuser}}"/> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Name</label>
                                       <input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="Name" name="fname" id="fname" value="{{request()->fname}}"/> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Email ID</label>
                                       <input type="text" class="form-control dt-input dt-email" data-column="5" placeholder="Email ID" name="femail" id="femail" value="{{request()->femail}}"/> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Contact No.</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" data-column="5" placeholder="Contact No." name="fmobile" id="fmobile" value="{{request()->fmobile}}"/> </div>
                                 </div>
                                 <!-- <div class="col-3">
                                    <div class="form-group">
                                       <label>Subscribed on</label>
                                       <input type="text" value="{{request()->fsubscribemin}}" name="fsubscribemin" id="fsubscribemin" class="form-control border-left-radius dt-input dt-full-name flatpickr-basic" data-column="5" placeholder="Min" data-column-index="0">
                                       <div class="input-group-append">
                                             <span class="input-group-text">
                                                <i data-feather="more-horizontal"></i>
                                             </span>
                                       </div>
                                       <input type="text" value="{{request()->fsubscribemax}}" name="fsubscribemax" id="fsubscribemax" class="flatpickr-basic form-control border-left-0 border-right-radius dt-input dt-salary" data-column="5" placeholder="Max" data-column-index="1">
                                    </div>
                                 </div> -->
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Package Name</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" data-column="5" placeholder="Package Name" name="fpackage" id="fpackage" value="{{request()->fpackage}}"/> </div>
                                 </div>
                                 <!-- <div class="col-3">
                                    <div class="form-group">
                                       <label>Payment Date</label>
                                       <input type="text" value="{{request()->fpaymentmin}}" name="fpaymentmin" id="fpaymentmin" class="form-control flatpickr-basic border-left-radius dt-input dt-full-name" data-column="5" placeholder="Min" data-column-index="0">
                                       <div class="input-group-append">
                                             <span class="input-group-text">
                                                <i data-feather="more-horizontal"></i>
                                             </span>
                                       </div>
                                       <input type="text" value="{{request()->fpaymentmax}}" name="fpaymentmax" id="fpaymentmax" class="form-control flatpickr-basic border-left-0 border-right-radius dt-input dt-salary" data-column="5" placeholder="Max" data-column-index="1">
                                    </div>
                                 </div> -->
                                 <div class="col-3">
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
                                 <div class="col-3">
                                    <div class="form-row mt-2">
                                       <button type="button" class="btn btn-primary mr-1" id="dt-feature-filter-form-search"><i class="fal fa-search"></i></button>
                                       <a href="{{route('subscriber')}}" class="btn btn-outline-secondary"><i class="fal fa-redo"></i></a>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="card basic-datatable table-fixedheader datatable-list">
                              <table class="dt-subscriber table table-bordered table-responsive">
                                 <thead>
                                    <tr>
                                          <th>User Id</th>
                                          <th>Subscriber Details</th>
                                          <th>Subscribed On</th>
                                          <th>Package Name</th>
                                          <th>Validity</th>
                                          <th>Payment Date</th>
                                          <th>Status</th>
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
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Subscription = function () {
      return { //main function to initiate the module
         init: function () {
            var dt_ajax_table = $('.dt-subscriber');
         var dt_ajax_url = "{{$dt_ajax_url}}";
         // alert(dt_ajax_url);
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
                     searchPlaceholder: 'Search for User ID',
                     paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                     }
               },
               drawCallback: function() {
                     $(document).find('[data-toggle="tooltip"]').tooltip();
               }
            });

         };

         //filtering
         $('body').on('click', '#dt-feature-filter-form-search', function(e) {
            e.preventDefault();
            var url = "{{route('subscriber')}}?search=1";
            if($('#fuser').val() != '') url += "&fuser="+encodeURIComponent($('#fuser').val());
            if($('#fname').val() != '') url += "&fname="+encodeURIComponent($('#fname').val());
            if($('#femail').val() != '') url += "&femail="+encodeURIComponent($('#femail').val());
            if($('#fmobile').val() != '') url += "&fmobile="+encodeURIComponent($('#fmobile').val());
            if($('#fpackage').val() != '') url += "&fpackage="+encodeURIComponent($('#fpackage').val());
            if($('#fstatus').val() != '') url += "&fstatus="+encodeURIComponent($('#fstatus').val());
            window.location.href = url;

         });

      }
   }   
}();

jQuery(document).ready(function() {
   Subscription.init();
});
</script>
@endpush