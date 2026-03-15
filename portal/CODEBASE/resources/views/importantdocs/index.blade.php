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
                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-md-2 pd-tb-5"><strong>Name:</strong></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control input-sm" name="fname" id="fname" value="{{request()->fname}}" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 pd-tb-5"><strong>Status:</strong></label>
                                                    <div class="col-md-9">
                                                        <select name="fstatus" id="fstatus" class="form-control input-sm">
                                                            <option value="">All</option>
                                                            <option value="1" {{request()->fstatus=='1'?'selected="selected"':''}}>Active</option>
                                                            <option value="0" {{request()->fstatus=='0'?'selected="selected"':''}}>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                 <div class="col-4">
                                       <div class="form-row mt-2">
                                          <button type="button" class="btn btn-primary mr-1" id="dt-feature-filter-form-search"><i class="fal fa-search"></i></button>
                                          <a href="{{route('importantdocs')}}" class="btn btn-outline-secondary"><i class="fal fa-redo"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="card basic-datatable table-fixedheader datatable-list">
                              <table class="dt-docs table table-bordered table-responsive">
                                 <thead>
                                    <tr>
                                          <th>Name</th>
                                          <th>Display Name</th>
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
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
var Documents = function () {

    return {

        //main function to initiate the module
        init: function () {
            var dt_ajax_table = $('.dt-docs');
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
                        searchPlaceholder: 'What are you looking for? ',
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    },
                    buttons: [{
                     className: 'btn btn-outline-secondary mr-2 add-doc',
                     text: feather.icons['plus'].toSvg({ class: 'font-small-4 mr-50' }) + 'Add New Document </a>',
                     attr:{
                        "href": "{{route('importantdocs.add')}}"
                        },
                     init: function(api, node, config) {
                           $(node).removeClass('btn-secondary');
                     }
                     }],
                    drawCallback: function() {
                        $(document).find('[data-toggle="tooltip"]').tooltip();
                    }
                });

                $('body').on('click', '.add-doc', function() {

                    window.location.href = "{{route('importantdocs.add')}}";

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
                            url: "{{route('importantdocs.changeStatus')}}", 
                            type:'post',
                            data: {table:'terms-conditions',id:switchControl.val(),status:state, _token: '{{csrf_token()}}'},
                            success: function(result){
                                swal('Important Documents', 'Status has been '+stateText+'d', "success");
                            }
                        });
                    }
                    else {
                        switchControl.bootstrapSwitch('state', !state);
                    }
                });
            });

                  $('.dt-docs').on('click', '.delete-record', function() {
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

            //filtering
            $('body').on('click', '#dt-feature-filter-form-search', function(e) {
                e.preventDefault();
                var url = "{{route('importantdocs')}}?search=1";

                if($('#fname').val() != '') url += "&fname="+encodeURIComponent($('#fname').val());
                if($('#fstatus').val() != '') url += "&fstatus="+encodeURIComponent($('#fstatus').val());

                window.location.href = url;

            });

            // Delete Brand
            $('body').on('click', '.dt-list-delete', function(event){
                event.preventDefault();
                // alert($(this).attr('del-url'));
                var url = $(this).attr('del-url');
                swal({
                    title: 'Are you sure?',
                    text: 'You want Delete the record.',
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
                            url: url, 
                            type:'post',
                            success: function(result){
                                swal('Document', 'Record Deleted Successfully', "success");
                                location.reload();
                            }
                        });
                    }
                    else {
                        swal("Cancelled", "", "error");
                    }
                });
            });

        }

    };

}();

jQuery(document).ready(function() {    
   Documents.init();
});
</script>
@endpush