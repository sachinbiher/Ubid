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
                                       <label>Subscribed on</label>
                                       <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                                    </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Package Name</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" data-column="5" placeholder="Contact No." /> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Payment Date</label>
                                       <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" /> </div>
                                 </div>
                                 <div class="col-3">
                                    <div class="form-group">
                                       <label>Status</label>
                                       <div class="w-100">
                                          <div class="floating-label">
                                             <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                                                <option value="0">Active</option>
                                                <option value="1"> In-active </option>
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
                  <div class="issue-btn-all">
                     <div class="">
                     <a href="#" class="btn btn-success waves-effect waves-float waves-light" data-toggle="modal" data-target="#editDocuments">Add Profile</a>
                     </div>
                  </div>
                  
                              <table class="dt-subscription table table-bordered table-responsive" >
                                 <thead>
                                    <tr>
                                          <th>S.no</th>
                                          <th>Profile Name</th>
                                          <th>Status</th>
                                    </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
         <div class="modal fade text-left" id="editDocuments" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
               <div class="modal-content file-manager-application">
                  <div class="modal-header">
                     <h4 class="modal-title text-primary" id="myModalLabel1">Add Profile</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                     </button>
                  </div>
                  <div class="modal-body p-2">
                     <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="Enter Role Name"> 
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                 <label>Status</label>
                              <div class="w-100">
                                    <div class="floating-label">
                                    <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                                       <option value="0">Active</option>
                                       <option value="1"> In-active </option>
                                    </select>
                                    <span class="highlight"></span>
                                    </div>
                                 </div>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label for="customFile" class="form-label">Illustrator image</label>
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input form-control" id="customFile">
                                 <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a href="#" class="btn btn-success float-right">Save</a>
                  </div>
                  
                  </div>
               </div>
            </div>
            </div>
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
   var Profile = function () {
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
                 filterByDate(a, t, l), $(".dt-subscription").dataTable().fnDraw()
             } else $(".dt-subscription").DataTable().column(a).search(e, !1, !0).draw()
         }
         $((function() {
             $("html").attr("data-textdirection");
             // AddProduct = 'edit-membership.html'
             var productlist = $(".dt-subscription")
             if ($("input.dt-input").on("keyup", (function() {
                     filterColumn($(this).attr("data-column"), $(this).val())
                 })), productlist.length) productlist.DataTable({
                 ajax: "app-assets/data/subscribers.json",
                 columns: [{
                     data: 'id'
                 },  {
                     data: 'status'
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
                 },{
                     className: 'text-left',
                     targets: 0,
                     width: '150px',
                     render: function(data, type, full, meta) {
                        var $name = full['name']
                        var $email = full['email']
                        var $contact = full['contact']
                        return('<span data-toggle="tooltip">1</span>');
                     }
                 }, {
                     className: 'text-left',
                     targets: 1,
                     width: '150px',
                     render: function(data, type, full, meta) {
                        var $name = full['name']
                        var $email = full['email']
                        var $contact = full['contact']
                        return('<span data-toggle="tooltip" title="' + $name + '">' + '<span class="text-dark font-weight-bold title-productname">' + $name + '</span>' + '</span>');
                     }
                 },
                  
                 {
                     targets: 2,
                     render: function(data, type, full, meta)  {
                        var $name = full['name']
                        var $email = full['email']
                        var $contact = full['contact']
                        return('<div class="custom-control custom-control-success custom-switch"><input type="checkbox" checked="" class="custom-control-input" id="customSwitch3" data-on-text="Active" data-off-text="In-active" data-size="small"><label class="custom-control-label" for="customSwitch3"></label></div>');
                     }
                 }],
                 dom: '<"row d-flex justify-content-between align-items-center m-1"' + '<"col-lg-1 d-flex align-items-center"l>' + '<"col-lg-3 "f>' + '<"col-lg-5 align-items-center justify-content-lg-end flex-wrap  p-0 d-none"<"dt-action-buttons text-right"B>>' + '>t' + '<"d-flex justify-content-between  mx-2"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
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
                 drawCallback: function() {
                     $(document).find('[data-toggle="tooltip"]').tooltip();
                 }
             });
         }));
      }
   }   
}();

jQuery(document).ready(function() {
   Profile.init();
});
</script>
@endpush