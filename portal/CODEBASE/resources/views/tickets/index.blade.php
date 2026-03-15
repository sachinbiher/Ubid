@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
<style>
   .dt-button{
      display:none !important;
   }
   .form-send-message{
      width: 90%!important;
      margin-left: 5%!important;
      margin-bottom: 2%!important;
   }
   .required
   {
      color:red !important;
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
                                       <input type="text" class="form-control dt-input dt-Name" name="fuser" id="fuser" placeholder="User ID" value="{{request()->fuser}}" />
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Ticket ID</label>
                                       <input type="text" class="form-control dt-input dt-Name" name="fticket" id="fticket" placeholder="Ticket ID" value="{{request()->fticket}}" />
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Name</label>
                                       <input type="text" class="form-control dt-input dt-Name" name="fname" id="fname" data-column="5" placeholder="Name" value="{{request()->fname}}" /> 
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Email ID</label>
                                       <input type="text" class="form-control dt-input dt-email" name="femail" id="femail" data-column="5" placeholder="Email ID" value="{{request()->femail}}" /> 
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Contact</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" name="fmobile" id="fmobile" data-column="5" placeholder="Contact" value="{{request()->fmobile}}" /> 
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Ticket Status</label>
                                       <div class="w-100">
                                          <div class="floating-label">
                                             <select class="floating-select select2 form-control form-control dt-input dt-full-name" name="fstatus" id="fstatus" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                                             <option value="">Select</option>   
                                             <option value="0"{{request()->fstatus=='0'?'selected="selected"':''}}>Open</option>
                                             <option value="1"{{request()->fstatus=='1'?'selected="selected"':''}}>Resolved</option>
                                             <option value="2"{{request()->fstatus=='2'?'selected="selected"':''}}>Re-Open</option>
                                             </select>
                                             <span class="highlight"></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-row mt-2">
                                       <button type="button" class="btn btn-primary mr-1" id="dt-feature-filter-form-search"><i class="fal fa-search"></i></button>
                                       <a href="{{route('ticket')}}" class="btn btn-outline-secondary"><i class="fal fa-redo"></i></a>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="card basic-datatable table-fixedheader datatable-list">
                              <table class="dt-subscription table table-bordered table-responsive">
                                 <thead>
                                    <tr>
                                          <th>User ID</th>
                                          <th>User Details</th>
                                          <th>Ticket ID</th>
                                          <th>Category</th>
                                          <th>Ticket raised On</th>
                                          <th>Issue</th>
                                          <th>Ticket Status</th>
                                          <th>Actions</th>
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
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Tickets = function () {
      return { //main function to initiate the module
         init: function () {
         $(window).on('load', function() {
             if (feather) {
                 feather.replace({
                     width: 14,
                     height: 14
                 });
             }
         });

         var dt_ajax_table = $('.dt-subscription');
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
                        searchPlaceholder: 'Search for Ticket ID',
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    },
                    drawCallback: function() {
                        $(document).find('[data-toggle="tooltip"]').tooltip();
                    }

                });

               }   
            
            //ticket message modal
            $('body').on('click', '.ticket-message', function(e) {
               var id = $(this).attr('id');
               // alert(id);
               $.ajax({
                  method:'post',
                  url: '{{route("ticket.message")}}',
                  data: {'id' : id, _token: '{{csrf_token()}}'},
                  success: function(data) {
                     if(data.status == 200){
                        $('#messageModal').modal('show');
                        if(data.result.attachments == null){
                           document.getElementById("ticket_image").style.display = "none";
                        }
                        else{
                           document.getElementById("ticket_image").style.display = "block";
                           $('.attachment-data').attr('src',data.result.attachments);
                        }
                        $('.message-data').html(' <h4>Issue Description:</h4>'+data.result.issue);
                        if(data.result.status == 1){
                           $('.remark-data').html(' <h4>Resolve Remark:</h4>'+data.result.remark);
                        }
                        else{
                           $('.remark-data').html('');
                        }
                     }
                  }
               });
               
            });

            // var status = document.getElementById("status"),
            //    remark = document.getElementById("remark");
            //    button = document.getElementById("update-remark");
            //    button.disabled = true;
            // if (status.value.length >=1 && remark.value.length>=1) {
            //     button.disabled = false;
            // } else {
            //     button.disabled = true;
            // }

            //ticket message modal
            $('body').on('click', '.conversation', function(e) {
               var id = $(this).attr('id');
               // alert(id);
               $('#conversationModal').modal('show');
               $("#id").val(id);
            });

            $("#editDocument").on("show.bs.modal", function(e) {        
                //load the  current values 
                $("#ticket_id").val($(e.relatedTarget).data('id'));
            });

            //filtering
            $('body').on('click', '#dt-feature-filter-form-search', function(e) {
                e.preventDefault();
                var url = "{{route('ticket')}}?search=1";
                if($('#fuser').val() != '') url += "&fuser="+encodeURIComponent($('#fuser').val());
                if($('#fticket').val() != '') url += "&fticket="+encodeURIComponent($('#fticket').val());
                if($('#fname').val() != '') url += "&fname="+encodeURIComponent($('#fname').val());
                if($('#femail').val() != '') url += "&femail="+encodeURIComponent($('#femail').val());
                if($('#fmobile').val() != '') url += "&fmobile="+encodeURIComponent($('#fmobile').val());
                if($('#fstatus').val() != '') url += "&fstatus="+encodeURIComponent($('#fstatus').val());
                window.location.href = url;
               //  alert(url);

            });
      }
   }   
}();

jQuery(document).ready(function() {
   Tickets.init();
});
</script>
@endpush