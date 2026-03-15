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
                                    <div class="col-3">
                                    <div class="form-group">
                                       <label>Name</label>
                                       <input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="Name" /> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Email ID</label>
                                       <input type="text" class="form-control dt-input dt-email" data-column="5" placeholder="Email ID" /> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Contact No.</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" data-column="5" placeholder="Contact No." /> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Organization</label>
                                       <input type="text" class="form-control dt-input dt-organization" data-column="5" placeholder="Organization" /> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Sponsored on</label>
                                       <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Category</label>
                                       <div class="w-100">
                                          <div class="floating-label">
                                             <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                                                <option value="0">Kitchen</option>
                                                <option value="1">Living Room</option>
                                                <option value="1">Drawing Room</option>
                                                <option value="1">Bed Room</option>
                                             </select>
                                             <span class="highlight"></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Payment Status</label>
                                       <div class="w-100">
                                          <div class="floating-label">
                                             <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                                                <option value="0">Paid</option>
                                                <option value="1">Pending</option>
                                             </select>
                                             <span class="highlight"></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                           <div class="card basic-datatable table-fixedheader datatable-list">
                              <table class="dt-vendors table table-bordered table-responsive">
                                 <thead>
                                    <tr>
                                          <th>Subscriber Details</th>
                                          <th>Organization</th>
                                          <th>Sponsored On</th>
                                          <th>Category</th>
                                          <th> Status</th>
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

<!-- Upload new banner modal-->
<div class="modal fade text-left" id="uploadBanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content file-manager-application">
            <div class="modal-header">
               <h4 class="modal-title text-primary" id="myModalLabel1">Upload New Banner</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body p-2">
               <form method="POST">
                  <div class="row">
                     <div class="col-12">
                        <div class="form-group">
                           <label>Image</label>
                           <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="customFile" />
                                 <label class="custom-file-label" for="customFile">Choose file</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="action-buttons text-right">
                     <button type="submit" class="btn btn-success">Save</button>
                  </div>
               </form>
            </div>
      </div>
   </div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Sponsored = function () {
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
         function filterColumn(a, e) {
             if (5 == a) {
                 var t = $(".start_date").val(),
                     l = $(".end_date").val();
                 filterByDate(a, t, l), $(".dt-vendors").dataTable().fnDraw()
             } else $(".dt-vendors").DataTable().column(a).search(e, !1, !0).draw()
         }
         $((function() {
             $("html").attr("data-textdirection");
             // AddProduct = 'edit-membership.html'
             var productlist = $(".dt-vendors")
             if ($("input.dt-input").on("keyup", (function() {
                     filterColumn($(this).attr("data-column"), $(this).val())
                 })), productlist.length) productlist.DataTable({
                 ajax: "app-assets/data/vendors.json",
                 columns: [{
                     data: 'name'
                 }, {
                     data: 'organization'
                 }, {
                     data: 'sponsored_on'
                 }, {
                     data: 'category'
                 }, {
                     data: 'payment_status'
                 }],
                 displayLength: 100,
                 scrollY: "350px",
                 scrollX: true,
                 scrollCollapse: true,
                 fixedColumns: {
                     leftColumns: 0,
                     rightColumns: 0
                 },
                 columnDefs: [{
                     orderable: false,
                     targets: [0]
                 },  {
                     className: 'text-left',
                     targets: 0,
                     width: '150px',
                     render: function(data, type, full, meta) {
                        var $name = full['name']
                        var $email = full['email']
                        var $contact = full['contact']
                        return('<span data-toggle="tooltip" title="' + $name + '">' + '<span class="text-dark font-weight-bold title-productname">' + $name + '</span>' + '</span>' + '<br> <span class="">Email ID:</span> ' + '<span class="text-secondary">' + $email + '</span>' + '<br> <span class="">Contact:</span> ' + '<span class="text-secondary">' + $contact + '</span>');
                     }
                 }, {                  
                     targets: 1,
                     className: 'list-data',
                     width: '150px',
                     render: function(data, type, full, meta) {
                         $organization = full['organization']
                         return ('<span class="title-label"> ' + $organization + '</span>');
                     }
                 }, {                     
                     targets: 2,
                     className: 'text-center list-data',
                     render: function(data, type, full, meta) {
                         $sponsored_on = full['sponsored_on']
                         return ('<span class="title-label"> ' + $sponsored_on + '</span>');
                     }
                 },  {
                     
                     targets: 3,
                     className: 'list-data',
                     width: '150px',
                     render: function(data, type, full, meta) {
                         $category = full['category']
                         return ('<span class="title-label"> ' + $category + '</span>');
                     }
                 }, 
                  {
                     targets: 4,
                     className: 'list-data',
                     width: '150px',
                     render: function(data, type, full, meta) {
                         $category = full['category']
                         return ('<span class="badge badge-pill badge-light-success" target="_blank">Accept</span> <span class="badge badge-pill badge-light-danger" target="_blank">Reject</span>');
                     }
                 }],
                 dom: '<"row d-flex justify-content-between align-items-center m-1"' + '<"col-lg-1 d-flex align-items-center"l>' + '<"col-lg-5 "f>' + '<"col-lg-3 d-flex align-items-center justify-content-lg-end flex-wrap  p-0"<"dt-action-buttons text-right"B>>' + '>t' + '<"d-flex justify-content-between  mx-2"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
                 // orderCellsTop: !0,
                 select: {
                     style: "multi",
                     selector: "td:first-child",
                     items: "row"
                 },
                 language: {
                     sLengthMenu: 'Show _MENU_',
                     search: '',
                     searchPlaceholder: ' What are you Looking For?',
                     paginate: {
                         // remove previous & next text from pagination
                         previous: '&nbsp;',
                         next: '&nbsp;'
                     }
                 },
                 buttons: [{
                  className: 'btn btn-outline-secondary mr-2',
                  text: '<a href="javascript:;" data-toggle="modal" data-target="#uploadBanner">' + feather.icons['upload'].toSvg({ class: 'font-small-4 mr-50' }) + 'Upload Banner Image</a>'
                }],
                 drawCallback: function() {
                     $(document).find('[data-toggle="tooltip"]').tooltip();
                 }
             });
         }));
      }
   }   
}();

jQuery(document).ready(function() {
   Sponsored.init();
});
</script>
@endpush