@extends('layouts.auth') @push('PAGE_ASSETS_CSS') <style>
    body {
        background: #Fff !important;
    }

    .bg-gold {
        background: linear-gradient(#af774e, #d3996c, #af774e);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .title-head {
        text-align: center;
        padding: 0px 0px;
        font-size: 44px;
        color: #000;
    }

    .btn-primary {
        font-size: 1.2vw;
        color: #212529;
        text-decoration: underline;
        padding: 9px 25px;
        border-radius: 30px;
        background: #000;
        margin-left: 5px;
        border: none;
        opacity: 1 !important;
    }

    .btn.bg-black {
        background: #000 !important;
        color: #fff;
    }

    .btn.bg-white {
        background: #fff !important;
        color: #000 !important;
    }
 
    /* input boxes */
    input {
        width: 100%;
    border: none;
    background: #fff;
    margin: 0px 0 5px 0;
    padding: 5px;
    height: 6vh;
    font-size: 0.9vw;
    border-radius: 0;
    }

    .not-regtxt {
        font-size: 1.2vw;
    }

    .button {
        font-size: 1.2vw;
        margin: 15px 0px;
        text-align: center;
        padding: 7px 35px;
        border: none;
        color: #fff;
        border-radius: 30px;
        background: #000 !important;
    }

    .m0-auto {
        margin: 0 auto;
        text-align: center;
    }

    .text-end a {
        font-size: 19px;
    }

   

    form .error:not(input) {
        color: red;
        font-size: 14px;
    }

    .styled-checkbox {
        display: inline-block;
        vertical-align: text-top;
        width: 20px;
        height: 20px;
        background: white;
        cursor: pointer;
        margin-right: 5px;
    }
  label
  {
    font-size: 1.2vw;
    color: #000;
  }
  
    .leftcircle-content p {
        color: #000;
        font-size: 22px;
        line-height: 35px;
    }

    .auth-register-form {
        padding: 20px 50px;
    }
    .navbar-brand
    {
        /* position:absolute;
        left:0;
        top:10px */
    }
    .label-note
    {
        font-size: 1.1vw;
    }
    .navbar-brand img {
        width: 221px;
    }
    .display-middle
    {
        height: 87vh;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    display: grid;
    }
    #toast-container .toast-success {
        background-color: #28c76f !important;
    }

    #toast-container .toast-error {
        background-color: #ea5455 !important;
    }

    @media (max-width: 768px) { 
        .positionabs
    {
        position: relative;
     }
     .bg-gold {
       
    height: auto;
    }
    .not-regtxt {
    font-size: 15px;
}
label {
    font-size: 13px!important;
}
.navbar-brand img {
    width: 150px;
    margin-top: 13px;
}

.entire-img
{
    margin-bottom: 23px;
}
.navbar-brand {
    width: 100%;
    text-align: center;
}
.title-head {
 
    font-size: 28px;
}

.auth-register-form {
    padding: 0px 29px;
}
.btn-primary {
    font-size: 16px;
    }
    .display-middle {
    height: auto;
    }
    input {
 
    font-size: 12px;
      }
    }
       
    #toast-container .toast-success {
        background-color: #28c76f !important;
    }

    #toast-container .toast-error {
        background-color: #ea5455 !important;
    }

</style> @endpush @section('content') <div class="container-fluid">

             
         
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8">
        <a class="navbar-brand" href="{{route('register')}}">
                    <img src="./app-assets/images/UBID-logo.png">
                </a>
                <div class="display-middle">

            <h1 class="title-head">Grow your Business with UBID</h1>
           
                <div class="col-lg-10 col-xl-10 m0-auto">
                    <img src="./app-assets/images/loginpage/loginpage.png" class="entire-img" />
</div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 bg-gold pb-2">
            <div class="">
                <div class="d-flex justify-content-center align-items-center pb-2 pt-1 positionabs">
                    <p class="text-light not-regtxt">Already a Member?</p>
                    <span class="spacer"></span>
                    <p><a class="btn btn-primary bg-white" href="{{route('login')}}">Log In</a></p>
                </div>
                <h1 class="title-head">Sign Up</h1>
                <div class="row ">
                   
                        <form class="auth-register-form auth-form-div mt-2" id="auth-register-form" action="{{route('sendVendorOtp')}}" method="POST" onsubmit="doRegister.disabled=true; return true;"> {!! csrf_field() !!} <div class="row">
                                <div class="col-lg-12 form-group mb-1">
                                    <label for="email">Email<span class="required"> * </span></label>
                                    <input type="text" id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Enter Your Email" aria-describedby="email" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" tabindex="1" />
                                    <span class="highlight">{{$errors->first('email')}}</span>
                                </div>
                                <div class="col-lg-12 form-group mb-1">
                                    <label for="mobile">Mobile<span class="required"> * </span></label>
                                    <input  maxlength="10" oninput="this.value=this.value.slice(0,this.maxLength)" id="mobile" type="number" name="mobile" autocomplete="off" value="{{old('mobile')}}" placeholder="Enter Your Mobile" aria-describedby="mobile" readonly onfocus="this.removeAttribute('readonly');" tabindex="1" />
                                    <span class="highlight">{{$errors->first('mobile')}}</span>
                                </div>
                                <div class="col-lg-12 form-group mb-0">
                                    <label class="label-note" >
                                        <input type="checkbox" class="styled-checkbox" name="tercon" id="tercon" />
                                        <a href="{{route('termsandconditions')}}" target="_blank" class="text-white"> I agree to all Terms & Conditions | </a>
                                        <a href="{{route('privacypolicy')}}" target="_blank" class="text-white"> Privacy Policy  |</a>
                                        <a href="{{route('vendoragreement')}}" target="_blank" class="text-white"> Vendor Agreement </a>
                                    </label>
                                </div>
                                <input type="checkbox" class="styled-checkbox" style='display:none' checked name="pripol" id="pripol" />
                                <div class="m0-auto mt-2">
                                    <button class="btn btn-primary bg-black text-decoration-none" name="doRegister" id="doRegister" value="doRegister" type="submit">Send OTP</button>
                                </div>
                            </div>
                        </form>
                   
                </div>
            </div>
        </div>
    </div> @stop @push('PAGE_ASSETS_JS') @endpush @push('PAGE_SCRIPTS') <script type="text/javascript">
        var cb1 = document.getElementById("tercon"),
            cb2 = document.getElementById("pripol"),
            button = document.getElementById("doRegister");
        button.disabled = true;
        document.getElementById("mobile").maxLength = "10";
        cb1.onclick = cb2.onclick = function() {
            if (cb1.checked && cb2.checked) {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        };
    </script> @endpush