@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')
@endpush

@section('content')
<div class="auth-wrapper auth-v2">
    <div class="auth-inner row m-0">
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 hidden-xs hidden-sm ">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
        </div>
        <!-- /Left Text-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-2">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <a class="brand-logo" href="javascript:void(0);">
                    <h2 class="brand-text text-success ">
                        <img class="img-fluid" src="app-assets/images/logo/logo.png" width="100" alt="Login V2">
                    </h2>
                </a>
                <h2 class="card-title font-weight-bold mb-0 text-center">Welcome Back !</h2>
                <p class="card-text text-center">Please sign-in to your account.</p>
                <form class="auth-login-form auth-form-div" id="auth-login-form" method="post" action="{{route('login')}}">
               
                {!! csrf_field() !!}
               
                     <div class="form-label-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text border-left-line cursor-pointer"><i data-feather="user"></i></span>
                            </div>
                            <input class="form-control border-right-line form-control-merge" id="email" type="text" name="email" placeholder="Enter Your Username" aria-describedby="email" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" tabindex="1"/>
                            <label for="email" class="float-label">Email<span class="required"> * </span></label>
                        </div>
                    </div>
                    <div class="form-label-group">
                        <div class="d-flex justify-content-end label-link position-absolute-right">
                            <a href="{{route('forgotPassword')}}" class="id-anchor">Forgot Password?</a>
                        </div>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text  border-left-line cursor-pointer"><i data-feather="lock"></i></span>
                            </div>
                            <input type="password" class="form-control border-right-line form-control-merge"
                            id="password" name="password" tabindex="1" placeholder="Enter Your Password"
                            aria-describedby="password" autocomplete="false"
                            readonly onfocus="this.removeAttribute('readonly');"/>
                            <label for="password" class="float-label">Password<span class="required"> * </span></label>
                            <div class="input-group-append">
                                <span class="input-group-text border-right-line  cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" name="doSubmit" id="doSubmit" value="doLogin" class="btn btn-success btn-block form-submit" tabindex="4">Sign in</button>
                    </div>
                </form>
        <p class="text-center mt-h5"><span>Have not registered yet?</span><a href="{{route('register')}}"><span>&nbsp;Register Now</span></a></p>
            </div>
        </div>
        <!-- /Login-->
    </div>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
var Login = function () {
    return { //main function to initiate the module
        init: function () {
            $('.auth-login-form').validate({
                rules: {
                    'email': {
                        required: true,
                        email: true
                    },
                    'password': {
                        required: true
                    }
                }
            });
            

            // // Form submit start
            // $('body').on('click', '#doSubmit', function(e) {
            //     e.preventDefault();
            //     $.ajax({
            //         type: "post",
            //         url: "{{route('login')}}",
            //         data: $('form.auth-login-form').serialize(),
            //         datatype: JSON,
            //         success: function(response) {
            //             if(response.status == 'validations') {
            //                 $.each(response.errors, function (key, error) {
            //                     $('form.auth-login-form').find("#" + key).removeClass('error').addClass('error');
            //                     $('form.auth-login-form').find("#" + key + "-error").text(error[0]);
            //                 });
            //             }

            //             if(response.status == 'success') {
            //                 window.location = "{{route('dashboard')}}"
            //             }

            //             if(response.status == 'error') {
            //                 JsUtility.showToastr('error', 'Login', response.message);
            //             }
            //         },
            //         error: function() {
            //             JsUtility.showToastr('error', 'Login', response.message);
            //         }
            //     });
            //     return false;
            // });
        }
    }
}();

jQuery(document).ready(function() {
    Login.init();
});
</script>
<script>
window.history.pushState(null, "", window.location.href);

window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};
</script>
@endpush
