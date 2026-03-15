@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
<style>
   .highlight {
      position:inherit !important;
      color:red !important;
   }
   .required
   {
      color:red !important;
   }
   *{
   -webkit-box-sizing: border-box;
   box-sizing: border-box;
   margin: 0;
   padding: 0;
   }
      
   #toast-container .toast-success {
        background-color: #28c76f !important;
    }

    #toast-container .toast-error {
        background-color: #ea5455 !important;
    }

</style>
@endpush

@section('content')
<div class="">
   <div class="content-overlay"></div>
   <div class="header-navbar-shadow"></div>
   <div class="content-wrapper">
      <div class="content-body">
         <section>
                  <div class="container">
                     <div class="row  change-password v-row">
                        <div class="col-lg-6 card offset-lg-3  mt-3 px-3 pt-3 pb-3 ">
                              <div id="changepassword" class="">
                                 <div class="content-header">
                                    <h4 class="mb-0 text-center">Change Password </h4>
                                 </div>
                                 <form class="auth-reset-password-form form-auth-div mt-2" action="{{route('changePassword')}}" method="post" enctype="multipart/form-data">
                                 {!! csrf_field() !!}

                                    <div class="form-group">
                                          <div class="d-flex justify-content-between">
                                             <label for="current_password">Old Password<span class="required"> * </span></label>
                                          </div>
                                          <div class="input-group input-group-merge form-password-toggle">
                                             <input value="{{ old('current_password') }}"  class="form-control form-control-merge" id="current_password" type="password" name="current_password" aria-describedby="current_password"  tabindex="1" />
                                             <div class="input-group-append"><span class="input-group-text border-right-line cursor-pointer"><i data-feather="eye"></i></span></div>
                                          </div>
                                          <span class="highlight">{{$errors->first('current_password')}}</span>
                                    </div>
                                    <div class="form-group">
                                          <div class="d-flex justify-content-between">
                                             <label for="new_password">New Password<span class="required"> * </span></label>
                                          </div>
                                          <div class="input-group input-group-merge form-password-toggle">
                                             <input  value="{{ old('new_password') }}"  class="form-control form-control-merge" id="new_password" type="password" name="new_password" aria-describedby="new_password" tabindex="2" />
                                             <div class="input-group-append"><span class="input-group-text  border-right-line cursor-pointer"><i data-feather="eye"></i></span></div>
                                             <span>Note: Your New Password must contain atleast 1 uppercase, lowercase, number and special character and should be of atleast 6 characters in length.</span>
                                          </div>
                                          <span class="highlight">{{$errors->first('new_password')}}</span>
                                    </div>
                                    <div class="form-group">
                                          <div class="d-flex justify-content-between">
                                             <label for="confirmed">Confirm Password<span class="required"> * </span></label>
                                          </div>
                                          <div class="input-group input-group-merge form-password-toggle">
                                             <input  value="{{ old('confirmed') }}" class="form-control form-control-merge" id="confirmed" type="password" name="confirmed" aria-describedby="confirmed" tabindex="3" />
                                             <div class="input-group-append"><span class="input-group-text border-right-line cursor-pointer"><i data-feather="eye"></i></span></div>
                                          </div>
                                          <span class="highlight">{{$errors->first('confirmed')}}</span>
                                    </div>
                                    <button type="submit" name="doSubmit" id="doSubmit" value="doLogin" class="btn btn-success btn-block" tabindex="3">Set New Password</button>
                                 </form>
                        
                              </div>
                        </div>
                     </div>
                  </div>
            </section>
      </div>
   </div>
</div>
<div class="modal fade float-labeldispaly" id="modals-report-in" tabindex="-1" role="dialog" aria-labelledby="editWarehouseTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <form class="col-lg-12 form-validate">
                  <div class="row ">
                     <h3 class="main-title mb-2"> Report</h3>
                     <div class="col-lg-12 col-md-12">
                        <div class="form-label-group form-group d-flex">
                           <textarea class="form-control" rows="2" id="floating-label1" placeholder="Report "></textarea>
                           <label for="floating-label1">Report: </label>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- BEGIN: Footer-->
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
   var Login = function () {
       return { //main function to initiate the module
           init: function () {
            $('.auth-reset-password-form').validate({
                rules: {
                  'current_password': {
                        required: true,
                    },
                    'new_password': {
                        required: true,
                    },
                    'confirmed': {
                        required: true,
                    }
                }
            });
      }
    }
}();

jQuery(document).ready(function() {
    Login.init();
});
</script>

@endpush
