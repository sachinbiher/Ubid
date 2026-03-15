@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
@endpush

@section('content')
<div class="">
   <div class="content-overlay"></div>
   <div class="header-navbar-shadow"></div>
   <div class="content-wrapper">
      <div class="content-body">
         <section class="parent-productlist advanced-search-datatable">
            
         @include('category.tabs')
         
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
                                    <div class="col-3">
                                    <div class="form-group">
                                       <label>Name</label>
                                       <input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="Name" name="fname" id="fname" value="{{request()->fname}}" /> </div>
                                 </div>
                                 <div class="col-3">
                                       <div class="form-group">
                                          <label>Status</label>
                                          <div class="w-100">
                                             <div class="floating-label">
                                                <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="" name="fstatus" id="fstatus">
                                                <option value="">Select</option>      
                                                <option value="1"{{request()->fstatus=='1'?'selected="selected"':''}}>Active</option>
                                                   <option value="0"{{request()->fstatus=='0'?'selected="selected"':''}}>In-Active</option>
                                                </select>
                                                <span class="highlight"></span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-3">
                                       <div class="form-row mt-2">
                                          <button type="button" class="btn btn-primary mr-1" id="dt-feature-filter-form-search"><i class="fal fa-search"></i></button>
                                          <a href="{{route('ticketcategory')}}" class="btn btn-outline-secondary"><i class="fal fa-redo"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="card basic-datatable table-fixedheader datatable-list">
                              <table class="dt-ticketcategories table table-bordered table-responsive">
                                 <thead>
                                    <tr>
                                          <th>S No</th>
                                          <th>Ticketing Category Name</th>
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
<!-- Add Edit Category Modal-->
<div class="modal fade text-left" id="ajaxModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document"></div></div>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Ticketcategories = function () {
      return { //main function to initiate the module
         init: function () {
         $(window).on('load', function() {
             if (feather) {
                 feather.replace({
                     width: 14,
                     height: 14
                 });
             }
         })
         var dt_ajax_table = $('.dt-ticketcategories');
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
                        searchPlaceholder: 'Search for Ticketing Category Name',
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    },
                    buttons: [{
                     className: 'btn btn-outline-secondary mr-2',
                     text: feather.icons['plus'].toSvg({ class: 'font-small-4 mr-50' }) + 'Add Ticketing Category </a>',
                     attr:{
                        "href": "{{route('ticketcategory.addEditTicketCategory')}}",
                        "data-toggle": "modal",
                        "data-target": "#ajaxModal"
                        }
                     }],
                    drawCallback: function() {
                        $(document).find('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
            $('body').on('change', '.custom-file-input', function(e) {
                  var fileName = e.target.files[0].name;
                  // alert(fileName);
                  $('.custom-file-label').text(fileName);
            });
            $('.dt-ticketcategories').on('click', '.delete-record', function() {
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

            // Modal form submit start
            $('body').on('submit', '#ticketcategory-save', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    contentType:false,
                    processData:false,
                    url: $('form.ticketcategory-save').attr('action'),
                    data: new FormData(this),
                    datatype: JSON,
                    success: function(response) {
                        if(response.status == 'validations') {
                            $.each(response.errors, function (key, error) {
                                $('form.ticketcategory-save').find("#" + key).removeClass('error').addClass('error');
                                $('form.ticketcategory-save').find("#" + key + "-error").text(error[0]);
                            });
                        }

                        if(response.status == 'success') {
                            window.location = "{{route('ticketcategory')}}"
                        }

                        if(response.status == 'error') {
                            JsUtility.showToastr('error', 'ticketcategory', response.message);
                        }
                    },
                    error: function() {
                        JsUtility.showToastr('error', 'SubCategory', response.message);
                    }
                });
                return false;
            });
            
            //filtering
            $('body').on('click', '#dt-feature-filter-form-search', function(e) {
                e.preventDefault();
                var url = "{{route('ticketcategory')}}?search=1";
                if($('#fname').val() != '') url += "&fname="+encodeURIComponent($('#fname').val());
                if($('#fstatus').val() != '') url += "&fstatus="+encodeURIComponent($('#fstatus').val());
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
    Ticketcategories.init();
});
</script>
@endpush