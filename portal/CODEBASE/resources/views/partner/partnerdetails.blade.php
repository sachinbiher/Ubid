@extends('layouts.app')

@section('content')


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
                                <h2 class="font-weight-bolder mb-0">Rs. {{$totalbids}}</h2>
                                <p class="card-text">Total Bidding</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i  class="font-medium-5">₹</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rs.{{$acceptedbids}}</h2>
                                <p class="card-text">Accepted Bidding</p>
                            </div>
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i  class="font-medium-5">₹</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">Rs. {{$pendingbids}}</h2>
                                <p class="card-text">Pending Bidding</p>
                            </div>
                            <div class="avatar bg-light-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i  class="font-medium-5">₹</i>
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
                            @if(count($subscriptiondetails) >0)
                            @foreach($subscriptiondetails as $subdetails)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="float-left">
                                    <h6 class="text-muted font-weight-bolder">Plan Name :</h6>
                                    <h5 class="mb-0 text-success">&nbsp;</h5>
                                </div>
                                @php $details = \App\Models\Subscription::where('id',$subdetails->subscription_id)->first(); @endphp
                       
                                <div class="float-center">
                                    <h6 class="text-muted font-weight-bolder">{{$details->name}}</h6>
                                    <h5 class="">&nbsp;</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="float-left">
                                    <h6 class="text-muted font-weight-bolder">Start Date :</h6>
                                    <h5 class="mb-0 text-success">&nbsp;</h5>
                                </div>
                                <div class="float-center">
                                    <h6 class="text-muted font-weight-bolder"> {{date('d M Y', strtotime($subdetails->subscribed_on))}} </h6>
                                    <h5 class="">&nbsp;</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="float-left">
                                    <h6 class="text-muted font-weight-bolder">End Date :</h6>
                                    <h5 class="mb-0 text-success">&nbsp;</h5>
                                </div>
                                
                                <div class="float-center">
                                    <h6 class="text-muted font-weight-bolder"> @if($subdetails->subscription_id =='1') -  @else {{date('d M Y', strtotime($subdetails->subscription_ends))}} @endif </h6>
                                    <h5 class="">&nbsp;</h5>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="float-left">
                                    <h6 class="text-muted font-weight-bolder">Plan Name</h6>
                                    <h5 class="mb-0 text-success">&nbsp;</h5>
                                </div>
                                <div class="float-center">
                                    <h6 class="text-muted font-weight-bolder">Free Plan</h6>
                                    <h5 class="">&nbsp;</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="float-left">
                                    <h6 class="text-muted font-weight-bolder">Start Date</h6>
                                    <h5 class="mb-0 text-success">&nbsp;</h5>
                                </div>
                                <div class="float-center">
                                    <h6 class="text-muted font-weight-bolder"> {{date('d M Y', strtotime($vendor_info->created_at))}} </h6>
                                    <h5 class="">&nbsp;</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="float-left">
                                    <h6 class="text-muted font-weight-bolder">End Date</h6>
                                    <h5 class="mb-0 text-success">&nbsp;</h5>
                                </div>
                                <div class="float-center">
                                    <h6 class="text-muted font-weight-bolder">-</h6>
                                    <h5 class="">&nbsp;</h5>
                                </div>
                            </div>
                            @endif
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
                                        <th class="text-center">S No</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Sub Category</th>
                                        <th class="text-center">Images</th>
                                        <th class="text-center">Uploaded On</th>
                                    </tr>
                                    @if(isset($vendor_projects))
                                        @php $j=1; @endphp
                                        @foreach($vendor_projects as $projects)
                                        <tr>
                                            @php $categoryval = App\Models\Category::where('id',$projects->category)->first(); 
                                            $subcategoryval = App\Models\ChildCategory::where('id',$projects->subcategory)->where('status',1)->first(); @endphp
                                            <td width="15%">{{$j}}</td>
                                            <td width="20%">{{$categoryval->name}}</td>
                                            <td width="15%">@if($projects->subcategory !='') {{$subcategoryval->name}} @else - @endif</td>
                                            @if($projects->images != '') @php $da = json_decode($projects->images,TRUE); $i=0; @endphp
                                            
                                            <td class="text-center" width="35%">
                                                <div class="avatar-group mt-0">
                                                @foreach($da as $img)
                                                @if($i < 5)
                                                <div class="avatar pull-up">
                                                    <img  src="{{url($img['name'])}}" alt="Avatar" width="33" height="33" />
                                                </div>
                                                @endif
                                                @php $i++; @endphp
                                                @endforeach
                                                <h6 class="align-self-center cursor-pointer ml-50 mb-0"><a  id="{{$projects->id}}" onclick="editproject(this)" data-toggle="modal" data-target="#viewAllProductImages">+view more</a></h6>
                                            </div>
                                            </td>
                                            @else
                                            <td></td>
                                            @endif

                                            <td width="15%">{{date('d M Y', strtotime($projects->created_at))}} </td>
                                        </tr>
                                        @php  $j++;@endphp
                                        @endforeach
                                    @else
                                        <tr colspan=5> No Products Added</tr>
                                    @endif

                                    
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
     
@stop



      <div class="modal fade text-left" id="viewAllProductImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content file-manager-application">
                <div class="modal-header">
                    <h4 class="modal-title text-primary" id="myModalLabel1">Images Uploaded View</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-2 text-center">
                    <div class="row my-1" id='imagesdiv'>
                    </div>
                     
                </div>
            </div>
        </div>
      </div>

    
      <div class="modal fade text-left" id="viewProductImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
            <div class="modal-content file-manager-application">
                <div class="modal-header">
                    <h4 class="modal-title text-primary" id="myModalLabel1">Image View</h4>
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
      

      <script>
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

        function editproject(n) {
                $.ajax({
                    method: 'get',
                    url: '{{route("ppanel.getprojectdetails")}}',
                    data: {
                        'projectid': n.id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data) {
                        const myArr =JSON.parse( data[0].images);
                        console.log(myArr.length);
                        var text = '';
                        for (i = 0; i < myArr.length; i++) {
                            text += ' <div class="col-md-2"><img  src=../../' + myArr[i].name + '  class="img-thumbnail" alt="Avatar" width="200" height="200"  /></div>'
                        }
                        $("#imagesdiv").html(text);
                    }
                });
            }

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
      </script>
      <script></script>
   </body>
   <!-- END: Body-->
</html>