@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
@endpush
<style>
	.required{
		color:red !important;
	}
</style>
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
                                       <label>Subscription Name</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" value="{{request()->fsubscription}}" data-column="5" placeholder="Subscription Name" name="fsubscription" id="fsubscription" /> </div>
                                 </div>
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
                                       <a href="{{route('subscription')}}" class="btn btn-outline-secondary"><i class="fal fa-redo"></i></a>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="card basic-datatable table-fixedheader datatable-list">
                              <table class="dt-subscription table table-bordered table-responsive">
                                 <thead>
                                    <tr>
                                          <th>Subscription Name</th>
                                          <th>Subscription Period (Months)</th>
                                          <th>Subscription Price (&#8377;)</th>
                                          <th>Final Price (&#8377;)</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                    </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
         <div class="modal fade text-left" id="viewDocuments" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
               <div class="modal-content file-manager-application">
                  <div class="modal-header">
                     <h4 class="modal-title text-primary" id="myModalLabel1">Add Subscription</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                     </button>
                  </div>
                  <div class="modal-body p-2">
                        <form id="subscription-save" name="subscription-save" action="{{route('subscription.add')}}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="row">
                           <div class="col-4">
                              <div class="form-group">
                                 <label>Subscription name <span class="required"> * </span></label>
                                 <input type="text" required maxlength='50' class="form-control dt-input dt-Name" name='name' id='name' data-column="5" placeholder="Enter Subscription Name"> 
                                 <span class="highlight">{{$errors->first('name')}}</span>
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <label>Subscription Period (In Months) <span class="required"> * </span></label>
                                 <select onchange="getmonths('a')" required class="form-control dt-input dt-full-type" name='period' id="period">
                                 <option value="">Please Select</option>
                                    <option value="1">Monthly</option>
                                    <option value="2">Yearly</option>
                                    <option value="3">Go Pro! (Monthly)</option>
                                    <option value="4">Go Pro! (Yearly)</option>
                                    <!-- <option value="0">Forever</option> -->
                                 </select> 
                              </div>
                           </div>
                           <input type='hidden' id='period_months' name='period_months' >
                           <input type="hidden" id='gopro' name='gopro'>
                           <div class="col-4">
                              <div class="form-group">
                                 <label>Status <span class="required"> * </span></label>
                                 <div class="w-100">
                                    <div class="floating-label">
                                    <select required class="floating-select select2 form-control form-control dt-input dt-full-name" name="status" id="status" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                                       <option value="">Select</option>
                                       <option value="1">Active</option>
                                       <option value="0"> In-active </option>
                                    </select>
                                    <span class="highlight"></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          
                           <div class="col-12">
                              <div class="form-group">
                                 <label>Description<span class="required"> * </span></label>
                                 <input type="text"  required class="form-control dt-input dt-contact-no" maxlength='100' name='description' id='description' data-column="5" placeholder="Description"> </div>
                                 <span class="highlight">{{$errors->first('description')}}</span>
                           </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>Subscription Price <span class="required"> * </span></label>
                                       <input type="text" required class="form-control dt-input dt-contact-no" name='price' id='price' data-column="5" placeholder="Subscription Price"> </div>
                                       <span class="highlight">{{$errors->first('price')}}</span>
                           </div>
                           
                           <div class="col-4"> 
                           <!-- //price discount finalprice -->
                                    <div class="form-group">
                                       <label>Discount (%) <span class="required"> * </span> </label>
                                       <input type="text" required class="form-control dt-input dt-contact-no" onchange='getfinalprice(1)' name='discount' id='discount' data-column="5" placeholder="Discount Percentage"> </div>
                                       <span class="highlight">{{$errors->first('discount')}}</span>
                           </div>
                           
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>Final Price</label>
                                       <input type="text" class="form-control dt-input dt-contact-no" readonly='true' name='finalprice' id='finalprice' data-column="5" placeholder="Final Price"> </div>
                                       <span class="highlight">{{$errors->first('finalprice')}}</span>
                           </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>View All Projects <span class="required"> * </span></label>
                                       <select required class="form-control" name="projectview" id="projectview">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('projectview')}}</span>
                           </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>Place bids on unlimited Projects <span class="required"> * </span></label>
                                       <select required class="form-control" name="placebids" id="placebids">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('placebids')}}</span>
                           </div>  
                           <div class="col-4"></div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>View Contact Details of Customers -<br>(When Bid is accepted) <span class="required"> * </span></label>
                                       <select required class="form-control" name="viewaccept" id="viewaccept">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('viewaccept')}}</span>
                          </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>View Contact Details of Customers -<br>(Just place Bid & Contact!) <span class="required"> * </span></label>
                                       <select required class="form-control" name="viewall" id="viewall">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('viewall')}}</span>
                           </div>
                           <div class="col-8">
                                    <div class="form-group">
                                       <label>Image <span class="required"> * </span></label>
                                       <div class="custom-file">
                                          <input type="file" required name="subscription_img" id="subscription_img" class="custom-file-input file-input1" type="file" ng2FileSelect
                                                [uploader]="uploader" id="file-upload-single" value='{{request()->subscription_img}}' />
                                          <label class="custom-file-label file-label1">Choose file</label>
                                          <span class="highlight">{{$errors->first('subscription_img')}}</span>
                                       </div>  
                                    </div>
                                       <span class="highlight">{{$errors->first('subscription_img')}}</span>
                           </div>
                           <div class="col-4"> </div>
                           
                        </div>
                        
                        <hr>
                        <div class="action-buttons text-right">
                           <button type="submit" class="btn btn-success waves-effect waves-float waves-light">Save</button>
                        </div>
                        </form>
                  </div>
               </div>
            </div>
            </div>
            </div>
             </section>
         </div>

         <div class="modal fade text-left" id="editDocuments" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
               <div class="modal-content file-manager-application">
                  <div class="modal-header">
                     <h4 class="modal-title text-primary" id="myModalLabel1">Edit Subscription</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                     </button>
                  </div>
                  <div class="modal-body p-2">
                        <form id="subscription-save" name="subscription-save" action="{{route('subscription.update')}}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type='hidden' name='sid' id='sid'>
                        <div class="row">
                           <div class="col-4">
                              <div class="form-group">
                                 <label>Subscription name <span class="required"> * </span></label>
                                 <input required type="text" maxlength='50' class="form-control dt-input dt-Name" name='edit_name' id='edit_name' data-column="5" placeholder="Enter Subscription Name"> 
                                 <span class="highlight">{{$errors->first('edit_name')}}</span>
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <label>Subscription Period (In Months)<span class="required"> * </span></label>
                                 <select required onchange="getmonths('e')" class="form-control dt-input dt-full-type" name='edit_period' id="edit_period">
                                    <option value=''>Please Select</option>
                                    <option value="1">Monthly</option>
                                    <option value="2">Yearly</option>
                                    <option value="3">Go Pro! (Montly)</option>
                                    <option value="4">Go Pro! (Yearly)</option>
                                 </select> 
                              </div>
                           </div>
                           <input type='hidden' id='edit_period_months' name='edit_period_months' >
                           <input type="hidden" id='edit_gopro' name='edit_gopro'>
                           <div class="col-4">
                              <div class="form-group">
                                 <label>Status <span class="required"> * </span></label>
                                 <div class="w-100">
                                    <div class="floating-label">
                                    <select required class="floating-select  form-control form-control dt-input dt-full-name" name="edit_status" id="edit_status" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                                       <option value="">Select</option>
                                       <option value="1">Active</option>
                                       <option value="0"> In-active </option>
                                    </select>
                                    <span class="highlight"></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          
                           <div class="col-12">
                              <div class="form-group">
                                 <label>Description <span class="required"> * </span></label>
                                 <input required type="text" class="form-control dt-input dt-contact-no"  maxlength='100' name='edit_description' id='edit_description' data-column="5" placeholder="Description"> </div>
                                 <span class="highlight">{{$errors->first('edit_description')}}</span>
                           </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>Subscription Price <span class="required"> * </span></label>
                                       <input required type="text" class="form-control dt-input dt-contact-no" name='edit_price' id='edit_price' data-column="5" placeholder="Subscription Price"> </div>
                                       <span class="highlight">{{$errors->first('edit_price')}}</span>
                           </div>
                           
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>Discount (%) <span class="required"> * </span></label>
                                       <input required type="text" class="form-control dt-input dt-contact-no" onchange='getfinalprice(2)' name='edit_discount' id='edit_discount' data-column="5" placeholder="Discount Percentage"> </div>
                                       <span class="highlight">{{$errors->first('edit_discount')}}</span>
                           </div>
                           
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>Final Price</label>
                                       <input type="text" class="form-control dt-input dt-contact-no"  readonly='true' name='edit_finalprice' id='edit_finalprice' data-column="5" placeholder="Final Price"> </div>
                                       <span class="highlight">{{$errors->first('edit_finalprice')}}</span>
                           </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>View All Projects<span class="required"> * </span></label>
                                       <select required class="form-control" name="edit_projectview" id="edit_projectview">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('edit_projectview')}}</span>
                           </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>Place bids on unlimited Projects <span class="required"> * </span></label>
                                       <select required class="form-control" name="edit_placebids" id="edit_placebids">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('edit_placebids')}}</span>
                           </div>  
                           <div class="col-4"></div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>View Contact Details of Customers -<br>(When Bid is accepted)<span class="required"> * </span></label>
                                       <select required class="form-control" name="edit_viewaccept" id="edit_viewaccept">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('edit_viewaccept')}}</span>
                          </div>
                           <div class="col-4">
                                    <div class="form-group">
                                       <label>View Contact Details of Customers -<br>(Just place Bid & Contact!)<span class="required"> * </span></label>
                                       <select required class="form-control" name="edit_viewall" id="edit_viewall">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select></div>
                                       <span class="highlight">{{$errors->first('edit_viewall')}}</span>
                           </div>
                           <div class="col-8">
                                    <div class="form-group">
                                       <label>Image</label>
                                       <div class="custom-file">
                                          <input type="file" name="edit_subscription_img" id="edit_subscription_img" class="custom-file-input file-input1" type="file" ng2FileSelect
                                                [uploader]="uploader" id="file-upload-single" value='{{request()->edit_subscription_img}}' />
                                          <label class="custom-file-label file-label1">Choose file</label>
                                          
                                       </div>  
                                    </div>
                                       <span class="highlight">{{$errors->first('edit_subscription_img')}}</span>
                           </div>
                           <div class="col-4"> <button style='top:23px;' type='button' class='btn btn-info' id='subscription1' value="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" data-toggle="modal" data-target="#imgmyModal" onclick="showSlides(this)" >View File</button> </div>
                           
                        </div>
                        
                        <hr>
                        <div class="action-buttons text-right">
                           <button type="submit" class="btn btn-success waves-effect waves-float waves-light">Update</button>
                        </div>
                        </form>
                  </div>
               </div>
            </div>
            </div>
            </div>
             </section>
         </div>

         <!--Image Popup -->

         <div class="modal fade text-left" id="imgmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
               <div class="modal-content file-manager-application">
                  <div class="modal-header">
                     <h4 class="modal-title text-primary" id="myModalLabel1">Image</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body p-2">
                        <div class="mySlides" style='display: none;'>
                        <img id='banner' style="width:200px">
                        </div>
                  </div>
               </div>
            </div>
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
   var Subscription = function () {
      return { //main function to initiate the module
         init: function () {

         var dt_ajax_table = $('.dt-subscription');
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
                     searchPlaceholder: 'Search by Subscription Name',
                     paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                     }
               },
               buttons: [{
                  className: 'btn btn-outline-secondary mr-2',
                  text: feather.icons['plus'].toSvg({ class: 'font-small-4 mr-50' }) + 'Add New Subscription </a>',
                  attr:{
                     "href": "{{route('subscription.add')}}",
                     "data-toggle": "modal",
                     "data-target": "#viewDocuments"
                     },
                  init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                  }
                  }],
               drawCallback: function() {
                     $(document).find('[data-toggle="tooltip"]').tooltip();
               }
            });

         };

            $('body').on('change', '.custom-file-input', function(e) {
               var fileName = e.target.files[0].name;
               // alert(fileName);
               $('.custom-file-label').text(fileName);
            });

         //filtering
         $('body').on('click', '#dt-feature-filter-form-search', function(e) {
            e.preventDefault();
            var url = "{{route('subscription')}}?search=1";
            if($('#fsubscription').val() != '') url += "&fsubscription="+encodeURIComponent($('#fsubscription').val());
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
   Subscription.init();
});

function getmonths(x)
{
   if(x=='a')
   {
      if($("#period").val()=='1'|| $("#period").val()=='3')
         $("#period_months").val('1');
      if($("#period").val()=='2'|| $("#period").val()=='4')
         $("#period_months").val('12');

      if($("#period").val()=='1'|| $("#period").val()=='2')
         $("#gopro").val('no');
      if($("#period").val()=='3'|| $("#period").val()=='4')
         $("#gopro").val('yes');
      

   }
      
   else(x=='e')
   {
      if($("#edit_period").val()=='1'|| $("#edit_period").val()=='3')
         $("#edit_period_months").val('1');
      if($("#edit_period").val()=='2'|| $("#edit_period").val()=='4')
         $("#edit_period_months").val('12');

      if($("#edit_period").val()=='1'|| $("#edit_period").val()=='2')
         $("#edit_gopro").val('no');
      if($("#edit_period").val()=='3'|| $("#edit_period").val()=='4')
         $("#edit_gopro").val('yes');
   }
}
function getdetails(n)
{

   $.ajax({
		method:'get',
		url: '{{route("subscription.getsubscription")}}',
		data: {'subscriptionid' : n.id, _token: '{{csrf_token()}}'},
		success: function(data) {
		   
         $("#sid").val(data[0].id);
         $("#edit_name").val(data[0].name);
         $("#edit_period").val(data[0].period);
         $("#edit_price").val(data[0].price);
         $("#edit_discount").val(data[0].discount);
         $("#edit_finalprice").val(data[0].finalprice);
         $("#edit_projectview").val(data[0].viewall);
         $("#edit_placebids").val(data[0].placebids);
         $("#edit_viewaccept").val(data[0].viewcontact_bidaccepted);
         $("#edit_viewall").val(data[0].viewaccepted_pro);
         $("#edit_status").val(data[0].status);
         $("#edit_description").val(data[0].description);
         $("#edit_period_months").val(data[0].period_months);
         $("#edit_gopro").val(data[0].gopro_type);
         
         

         if(data[0].image != null)
				$('#subscription1').val(data[0].image);
         
		}
	});
}

function getfinalprice(n)
{
   if(n==1){
      var price=  $("#price").val();
      var discount=  $("#discount").val();
      $("#finalprice").val(price-(price*discount)/100);
   }
   else if(n==2)
   {
      var price=  $("#edit_price").val();
       var discount=  $("#edit_discount").val();
       $("#edit_finalprice").val(price-(price*discount)/100);
   }

  


}
//image popup
function showSlides(n) {
    const img = document.getElementById("banner");
    img.onload = function () {};
    img.src = n.value;
    var slides = document.getElementsByClassName("mySlides");

    slides[0].style.display = "block";
}


</script>
@endpush