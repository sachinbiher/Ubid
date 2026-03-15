@extends('layouts.auth') @push('PAGE_ASSETS_CSS')
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    #loading {
        position: fixed;
        display: block;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
    }

    #loading-image {
        position: absolute;
        top: 26%;
        left: 35%;
        z-index: 100;
    }

    /*-- start here--*/
    a {
        text-decoration: none;
    }

    .logo {
        margin: 25px 80px;
    }

    .logo img {
        height: 60px;
    }

    @media (max-width:767px) {
        #otp-form input {
    width: 12.6% !important;
}
.element-main {
    margin: 20px;
    width: 100%;
    padding: 30px 15px 20px 15px;
        }
        .logo {
            margin: 25px 20px !important;
        }

        .logo img {
            height: 40px !important;
        }
    }

    /*--element style start here--*/
    .elelment h2 {
        font-size: 1.2rem;
        color: #000;
        text-align: center;
        margin-top: 3rem;
        font-weight: 700;
    }

    .element-main {
        background: linear-gradient(#af774e, #d3996c, #af774e);
    border-radius: 5px;
    text-align: center;
    padding: 30px 30px 20px 15px;
    }

    .element-main h1 {
        text-align: center;
    font-size: 2.3rem;
    color: #000000;
    font-weight: 700;
    margin-top: -65px;
    text-decoration: underline;
    }

    .element-main p {
        font-size: 1rem;
        color: #696969;
        line-height: 1.5rem;
        margin: 1.5rem 0;
        text-align: center;
    }

    .element-main input[type="text"] {
        margin-left: 13px;
        font-size: 1rem;
        color: #A29E9E;
        padding: 1rem 0.5rem;
        display: block;
        width: 13%;
        outline: none;
        margin-bottom: 1rem;
        text-align: center;
        border: 1px solid #B9B9B9;
    }


    .element-main button[type="submit"]:hover {
        background: #1D1C1C;
        border-bottom: 3px solid #2F2F2F;
        transition: 0.5s all;
        -webkit-transition: 0.5s all;
        -moz-transition: 0.5s all;
        -o-transition: 0.5s all;
    }



    /*---copyrights--*/
    .copy-right {
        margin: 2rem 0rem 0rem 0rem;
    }

    .copy-right p {
        text-align: center;
        font-size: 19px;
        color: #000;
        line-height: 1.5rem;
    }

    .copy-right p a {
        color: #fff;
    }

    .copy-right p a:hover {
        color: #000;
        transition: 0.5s all;
        -webkit-transition: 0.5s all;
        -moz-transition: 0.5s all;
        -o-transition: 0.5s all;
    }

    /*--element end here--*/
    /*--media quiries start here--*/
    @media(max-width:1440px) {}

    @media(max-width:1366px) {}

    @media(max-width:1280px) {
        .elelment h2 {
            margin-top: 1rem;
        }

        .copy-right {
            margin: 6rem 0rem 2rem 0rem;
        }
    }



    @media(max-width:640px) {}

    @media(max-width:480px) {


        .copy-right {
            margin: 5rem 0rem 2rem 0rem;
        }

        .copy-right p {
            font-size: 0.9rem;
        }


    }

    @media(max-width:320px) {
        .elelment h2 {
            font-size: 1.5rem;
        }

        .element-main h1 {
            font-size: 1.5rem;
        }

        .element-main {
            width: 80%;
            margin: 2rem auto 0rem;
            padding: 1.5rem 1.5rem;
        }

        .element-main p {
            font-size: 0.9rem;
        }

        .element-main button[type="submit"] {
            font-size: 0.9rem;
            width: 75%;
        }

        .element-main input[type="text"] {
            font-size: 0.9rem;
            padding: 0.8rem 0.5rem;
        }

        .copy-right {
            margin: 3rem 0rem 2rem 0rem;
        }

        .copy-right p {
            font-size: 0.85rem;
            padding: 0 4px;
        }
    }

    /*--media quiries end here--*/
    /* otp verification */
    #otp-form {
        max-width: 550px;
        margin: 25px 10px 0;
    }

    #otp-form input {
        display: inline-block;
        text-align: center;
        font-size: 20px;
        border: solid 1px #000;
        outline: none;
        transition: all 0.2s ease-in-out;
        border-radius: 3px;
    }

    #otp-form input:focus {
        border-color: #2eeab7;
        box-shadow: 0 0 5px #2eeab7 inset;
    }

    #email-error {
        margin-left: 86px !important;
    }
    .btn-primary {
        font-size: 16px;
    color: #212529;
    /* text-decoration: underline; */
    padding: 9px 25px;
    background: #000 !important;
    margin-left: 5px;
    border: none;
    }
    #resend_otp {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        font-size: 19px;
        cursor: pointer;
        outline: inherit;
        display: inline !important;
        color: #fff;
    }

    #toast-container .toast-success {
        background-color: #28c76f !important;
    }

    #toast-container .toast-error {
        background-color: #ea5455 !important;
    }
   .bg-black
   {
       color:#fff;
   }
   h4
   {
    width: 100%;
    font-size: 18px;
    margin-top: 16px;
    color: #000;
   }
   h1 i
   {
    display: table !important;
    background: #fff;
    border-radius: 50%;
    margin: 0 auto;
    font-size: 29px !important;
    color: #b67e54;
    width: 60px;
    height: 60px;
    line-height: 60px !important;
   }
    .navbar-brand img {
        width: 221px;
    }

    * {
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

</style> @endpush @section('content') <div class="container-fluid">
    <div class="col-xl-8 col-lg-6">
        <div class="py-2">
            <a class="navbar-brand" href="{{route('login')}}">
                <img src="./app-assets/images/UBID-logo.png">
            </a>
        </div>
    </div>
    <!--element start here-->
    <div class="row elelment">
        <h2></h2>
        <div class="col-lg-4 offset-lg-4 element-main">
            <h1 class="title-head text-white"><i class="fa fa-check-square-o fa-2x"></i> Verify OTP</h1>
            <form class="auth-otp-form mt-2 ng-untouched ng-pristine ng-valid" id="otp-form" method="post" enctype="multipart/formdata"> {!! csrf_field() !!}
                <div class="row" id="otp-screen">
                <h4  style=""> Enter the OTP sent to your Email Address.</h4>
                    <input type="hidden" class="form-control" name="verify_email" id="verify_email" value="{{ Session::get('email') }}">
                    <input type="hidden" class="form-control" name="verify_mobile" id="verify_mobile" value="{{ Session::get('mobile') }}">
                    <input class="otp" name="otp[]" id="first" type="text" maxlength=1 required autocomplete="off"d>
                    <input class="otp" name="otp[]" id="second" type="text" maxlength=1 required autocomplete="off">
                    <input class="otp" name="otp[]" id="third" type="text" maxlength=1 required autocomplete="off">
                    <input class="otp" name="otp[]" id="fourth" type="text" maxlength=1 required autocomplete="off">
                    <input class="otp" name="otp[]" id="fifth" type="text" maxlength=1 required autocomplete="off">
                    <input class="otp" name="otp[]" id="sixth" type="text" maxlength=1 required autocomplete="off">
                </div>
                <span id="otp[]-error" class="error"></span>
                <h4 > Enter the OTP sent to your Mobile Number.</h4>
                <div class="row justify-content-center" id="otp-screen1">
                    <input class="otp" name="otp1[]" id="first" type="text" maxlength=1 required autocomplete="off">
                    <input class="otp" name="otp1[]" id="second" type="text" maxlength=1 required autocomplete="off">
                    <input class="otp" name="otp1[]" id="third" type="text" maxlength=1 required autocomplete="off">
                    <input class="otp" name="otp1[]" id="fourth" type="text" maxlength=1 required autocomplete="off">
                    <div class="col-lg-12">
                    <button class='btn btn-primary bg-black' type="submit" name="doVerify" id="doVerify" value="doVerify">Verify</button>
                    </div>
                </div>
                <!-- <input class="otp" name="otp1[]" type="text" maxlength=1 required>
                <input class="otp" name="otp1[]" type="text" maxlength=1 required> -->
                 </form>
            <form action="{{route('resendOtp')}}" method="post" enctype="multipart/formdata" onsubmit="resend_otp.disabled=true; return true;"> {!! csrf_field() !!} <input type="hidden" class="form-control" name="verify_email" id="verify_email2" value="{{ Session::get('email') }}"> <input type="hidden" class="form-control" name="verify_mobile" id="verify_mobile" value="{{ Session::get('mobile') }}">

                <p class="text-center mt-2 text-white">
                    <!-- <span> Not Received OTP? </span><a href="#"><span> &nbsp;Resend</span></a> -->
                    <span> Not Received OTP? </span><button type="submit" class="resend_otp" id="resend_otp">Resend</button>
                </p>
            </form>
        </div>
    </div>
    <div class="copy-right">
        <p>© 2021 UBID. All rights reserved.</p>
    </div>
    <!-- <div id="loading">
        <img id="loading-image" src="{{url('app-assets/images/loading.gif')}}" alt="Loading..." />
    </div> -->
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
    var Register = function() {
        return { //main function to initiate the module
            init: function() {
                //   $(window).load(function() {
                //         $('#loading').hide();
                //     });
            }
        }
    }();
    jQuery(document).ready(function() {
        Register.init();
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    function OTPInput() {
        const inputs = document.querySelectorAll('#otp-screen > *[id]');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('keydown', function(event) {
                if (event.key==="Backspace" ) {
                    inputs[i].value='' ;
                        if (i !==0) inputs[i - 1].focus();
                    }
                else {
                        if (i===inputs.length - 1 && inputs[i].value !=='' ) {
                            return true;
                            }
                        else if (event.keyCode> 47 && event.keyCode < 58) {
                            inputs[i].value=event.key;
                            if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault();
                        }
                        else if (event.keyCode> 64 && event.keyCode < 91) {
                            inputs[i].value=String.fromCharCode(event.keyCode);
                            if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault();
                        }
                    }
            });
        }
    }
    OTPInput();

    function OTPInput1() {
        const inputs = document.querySelectorAll('#otp-screen1 > *[id]');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('keydown', function(event) {
                if (event.key==="Backspace" ) {
                    inputs[i].value='' ;
                        if (i !==0) inputs[i - 1].focus();
                    }
                else {
                        if (i===inputs.length - 1 && inputs[i].value !=='' ) {
                            return true;
                            }
                        else if (event.keyCode> 47 && event.keyCode < 58) {
                            inputs[i].value=event.key;
                            if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault();
                        }
                        else if (event.keyCode> 64 && event.keyCode < 91) {
                            inputs[i].value=String.fromCharCode(event.keyCode);
                            if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault();
                        }
                    }
            });
        }
    }
    OTPInput1();
});
</script>
@endpush
