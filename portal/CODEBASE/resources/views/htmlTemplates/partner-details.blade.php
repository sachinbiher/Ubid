@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
@endpush

@section('content')
<div class="">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
        <section id="statistics-card">
            <div class="row mt-3 mx-2">
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rs. 1000.00</h2>
                                <p class="card-text">Total Bidding</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rs. 500.00</h2>
                                <p class="card-text">Accepted Bidding</p>
                            </div>
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rs. 500.00</h2>
                                <p class="card-text">Pending Bidding</p>
                            </div>
                            <div class="avatar bg-light-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--/ Statistics Card section-->
            <section class="row mx-2">

        <!-- Profile Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-profile">
                <div class="card-body pt-1">
                    <h3>Subscription Details</h3>
                    <h6 class="text-muted">&nbsp;</h6>
                    <h6 class="text-muted">&nbsp;</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="float-left">
                            <h6 class="text-muted font-weight-bolder">&nbsp;</h6>
                            <h5 class="mb-0 text-success">&nbsp;</h5>
                        </div>
                        <div class="float-right">
                            <h6 class="text-muted font-weight-bolder">&nbsp;</h6>
                            <h5 class="">&nbsp;</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="float-left">
                            <h6 class="text-muted font-weight-bolder">&nbsp;</h6>
                            <h5 class="mb-0 text-success">&nbsp;</h5>
                        </div>
                        <div class="float-right">
                            <h6 class="text-muted font-weight-bolder">&nbsp;</h6>
                            <h5 class="">&nbsp;</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Profile Card -->

        <!-- Developer Meetup Card -->
            <div class="col-lg-8 col-md-6 col-12">
                <div class="card card-developer-meetup">
                    <div class="card-header">
                        <h4 class="card-title">Products Uploaded</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Sub Category</th>
                                    <th class="text-center">Images</th>
                                    <th class="text-center">Uploaded On</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Kitchen</td>
                                    <td>Trolley</td>
                                    <td class="text-center">
                                        <div class="avatar-group mt-0">
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <h6 class="align-self-center cursor-pointer ml-50 mb-0"><a  data-toggle="modal" data-target="#viewAllProductImages">+42</a></h6>
                                    </div>
                                    </td>
                                    <td>10 June 2021</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Kitchen</td>
                                    <td>Chimney</td>
                                    <td class="text-center">
                                    <div class="avatar-group mt-0">
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <h6 class="align-self-center cursor-pointer ml-50 mb-0"><a  data-toggle="modal" data-target="#viewAllProductImages">+42</a></h6>
                                    </div>
                                    </td>
                                    <td>10 June 2021</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Kitchen</td>
                                    <td>Dish Washer</td>
                                    <td class="text-center">
                                        <div class="avatar-group mt-0">
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <div class="avatar pull-up" data-toggle="modal" data-target="#viewProductImages">
                                            <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="33" height="33" />
                                        </div>
                                        <h6 class="align-self-center cursor-pointer ml-50 mb-0"><a  data-toggle="modal" data-target="#viewAllProductImages">+42</a></h6>
                                    </div>
                                    </td>
                                    <td>10 June 2021</td>
                                </tr>
                            </thead>
                        </table>
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
<!-- Vie All Products Modal-->
<div class="modal fade text-left" id="viewAllProductImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content file-manager-application">
            <div class="modal-header">
                <h4 class="modal-title text-primary" id="myModalLabel1">Products Uploaded</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2 text-center">
                <div class="row my-1">
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                </div>
                <div class="row my-1">
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                    <div class="col-md-2">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" class="img-thumbnail" alt="Avatar" width="200" height="200" data-toggle="modal" data-target="#viewProductImages" />
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="viewProductImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
        <div class="modal-content file-manager-application">
            <div class="modal-header">
                <h4 class="modal-title text-primary" id="myModalLabel1">Products Uploaded</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2 text-center">
                    <img src="app-assets/images/avatars/avatar-s-11.jpg" alt="Avatar" width="200" height="200" />
            </div>
        </div>
    </div>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
    var Partners = function () {
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
      </script>
      <script>
         function filterColumn(a, e) {
             if (5 == a) {
                 var t = $(".start_date").val(),
                     l = $(".end_date").val();
                 filterByDate(a, t, l), $(".dt-business-partners").dataTable().fnDraw()
             } else $(".dt-business-partners").DataTable().column(a).search(e, !1, !0).draw()
         }
         $((function() {
             $("html").attr("data-textdirection");
             // AddProduct = 'edit-membership.html'
             var productlist = $(".dt-business-partners")
             if ($("input.dt-input").on("keyup", (function() {
                     filterColumn($(this).attr("data-column"), $(this).val())
                 })), productlist.length) productlist.DataTable({
                 ajax: "app-assets/data/partners.json",
                 columns: [{
                     data: 'id'
                 }, {
                     data: 'name'
                 }, {
                     data: 'email'
                 }, {
                     data: 'contact'
                 }, {
                     data: 'organization'
                 }, {
                     data: 'change_status'
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
                 }, {
                    targets: 0,
                    orderable: false,
                    render: function(e, t, a, s) {
                        return "display" === t && (e = '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value=""  id="checkbox2"><label class="custom-control-label"  for="checkbox2" ></label></div>'), e
                    },
                    checkboxes: {
                        selectRow: !0,
                        selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /> <label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                    }
                }, {
                     className: 'text-center',
                     targets: 1,
                     width: '150px',
                     render: function(data, type, full, meta) {
                         var $name = full['name']
                         return ('<span class="title-label"><a href="partner-details.html" target="_blank">' + $name + '</a></span>');
                     }
                 }, {
                     // Invoice status
                     targets: 2,
                     className: 'text-center list-data',
                     render: function(data, type, full, meta) {
                         $email = full['email']
                         return ('<span class="title-label"> ' + $email + '</span>');
                     }
                 }, {
                     // Invoice status
                     targets: 3,
                     className: 'list-data',
                     width: '150px',
                     render: function(data, type, full, meta) {
                         $contact = full['contact']
                         return ('<span class="title-label"> ' + $contact + '</span>');
                     }
                 },  {
                     // Invoice status
                     targets: 4,
                     className: 'list-data',
                     width: '150px',
                     render: function(data, type, full, meta) {
                         $organization = full['organization']
                         return ('<span class="title-label"> ' + $organization + '</span>');
                     }
                 }, {
                     // Invoice status
                     targets: 5,
                     className: 'list-data',
                     width: '150px',
                     render: function(data, type, full, meta) {
                       return ('<div class="custom-control custom-control-success custom-switch"><input type="checkbox" checked class="custom-control-input" id="customSwitch3" data-on-text="Active" data-off-text="In-active" data-size="small" /><label class="custom-control-label" for="customSwitch3"></label></div>');
                   }
                 }, {
                     // Label
                     targets: 6,
                     render: function(data, type, full, meta) {
                                return ('<a href="javascript:;" class="text-secondary" title="View Documents" data-toggle="modal" data-target="#viewDocuments">' + feather.icons['eye'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + '</a>');
                            }
                 }
                 ],
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
   Partners.init();
});
</script>
@endpush