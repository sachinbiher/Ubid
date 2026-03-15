@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')
<style>
   .highlight {
      position:inherit !important;
      color:red;
   }
   .otp-input{
    margin-right: 8px;
    width: 50px;
    height: 50px;
    border-radius: 4px;
    border: 1px solid #c5c5c5;
    text-align: center;
    font-size: 32px;
   }
   button, input[type="submit"]{
	background: none;
	color: blue;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
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
        <!-- Verify Otp -->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5 otppopsection" id="otppopsection">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title font-weight-bold mb-1">Verify OTP</h2>
                Enter the OTP Received on your Email Address
                    <form class="auth-otp-form mt-2 ng-untouched ng-pristine ng-valid" method="post" enctype="multipart/formdata">
                    {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="verify_email" id="verify_email" value="{{ Session::get('email') }}">
                            <input type="text" class="form-control border-right-line form-control-merge" placeholder="Enter Your Email OTP" name="otp" id="otp"/>
                            <span class="highlight">{{$errors->first('otp')}}</span>
                        </div>
                        <button tabindex="4" rippleeffect="" class="btn btn-primary btn-block waves-effect waves-float waves-light" name="doVerify" id="doVerify" value="doVerify"> Verify </button>
                    </form>
                    <form action="{{route('resendOtp')}}" method="post" enctype="multipart/formdata">
                    {!! csrf_field() !!}
                    <input type="hidden" class="form-control" name="verify_email" id="verify_email2" value="{{ Session::get('email') }}">
                    <p class="text-center mt-2">
                        <!-- <span> Not Received OTP? </span><a href="#"><span> &nbsp;Resend</span></a> -->
                        <span> Not Received OTP? </span><button type="submit">Resend</button>

                    </p>
                    </form>
                </div>
            </div>
        </div>        
        <!-- /Verify Otp -->
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
            $('.auth-otp-form').validate({
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
