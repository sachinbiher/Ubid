@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')
<style>
   .highlight {
      position:inherit !important;
      color:red;
   }
</style>
@endpush

@section('content')
<div class="auth-wrapper auth-v2">
    <div class="auth-inner row m-0">
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 hidden-xs hidden-sm ">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
        </div>
        <!-- /Left Text-->
        <!-- Register New-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5 registersection" id="registersection">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title font-weight-bold mb-1">Welcome to UBID! 👋</h2>
                    <form class="auth-register-form auth-form-div mt-2" action="{{route('sendVendorOtp')}}"  method="POST" >
                    {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="login-email" class="form-label">Email<span class="required"> * </span></label>
                            <input type="text" placeholder="Enter Email" aria-describedby="login-email" autofocus="" tabindex="1" class="form-control" name="email" id="email">
                        <span class="highlight">{{$errors->first('email')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="login-email" class="form-label">Mobile Number<span class="required"> * </span></label>
                            <input type="number" placeholder="Enter Mobile Number" aria-describedby="login-email" autofocus="" tabindex="1" class="form-control" name="mobile" id="mobile">
                        <span class="highlight">{{$errors->first('mobile')}}</span>
                        </div>
                        <button tabindex="4" rippleeffect="" name="doRegister" id="doRegister" value="doRegister" class="btn btn-primary btn-block waves-effect waves-float waves-light SendOtp-registration"><!---->Continue </button>
                    </form>
                    <p class="text-center mt-2"><span>Already on our platform?</span><a href="{{route('login')}}"><span>&nbsp;Login</span></a></p>
            </div>
        </div>
        <!-- /Register New-->        
    </div>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
var Register = function () {
    return { //main function to initiate the module
        init: function () {
            $('.auth-register-form').validate({
                rules: {
                    'email': {
                        required: true,
                        email: true
                    },
                    'mobile': {
                        required: true
                    }
                }
            });
            
        }
    }
}();

jQuery(document).ready(function() {
    Register.init();
});
</script>
<script>
window.history.pushState(null, "", window.location.href);

window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};
</script>
@endpush