@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')

<style>
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
        font-size: 1.2vw;
    }

    .error {
    color: red !important;
    font-size: 14px;
}

    form .error:not(input) {
        color: darkred;
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

    .auth-login-form {
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
    /* display: flex; */
    color: #fff;

    }
    .navbar-brand img {
        width: 221px;
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

.auth-login-form {
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
      .text-end a {
        font-size: 12px;
    }
    }
    .label-note a
    {
        color:#fff;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-xl-8 col-lg-8 col-md-8">
            <div class="pt-1">
                <a class="navbar-brand" href="{{route('login')}}">
                  <img src="./app-assets/images/UBID-logo.png">
                </a>
            </div>
           
                <h1 class="title-head">Grow your Business with UBID</h1>
           
           
            <div class="col-lg-10 col-xl-10 m0-auto">
                    <img src="./app-assets/images/loginpage/loginpage.png" class="entire-img" />
               
           
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 bg-gold pt-1">
          <div class="">
            <div class="d-flex justify-content-center align-items-center pb-3">
              <p class="text-light not-regtxt">Not Registered yet?</p>
              <span class="spacer"></span>
              <p><a class="btn btn-primary bg-white" href="{{route('register')}}">Sign Up </a></p>  
            </div>
            <h1 class="title-head">Log In</h1>
            <div class="row v-row">
              <div class="col-lg-12">
             
               <form class="auth-login-form auth-form-div" id="auth-login-form" method="post" action="{{route('login')}}">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-lg-12 form-group mb-1">
                            <label for="email">Email<span class="required"> * </span></label>
                            <input type="email" id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Enter Your Email" aria-describedby="email" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" tabindex="1" />
                            <span class="highlight">{{$errors->first('email')}}</span>
                        </div>
                        <div class="col-lg-12 form-group mb-1">
                            <label for="password">Password<span class="required"> * </span></label>
                            <input type="password" id="password" name="password" autocomplete="off" tabindex="1" placeholder="Enter Your Password" aria-describedby="password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" />
                        </div>
                        <!-- <div class="col-lg-6 form-group mb-0 block1">
                            <label class="label-note needhelp d-flex align-items-center">
                                <input type="checkbox" class="styled-checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}" />
                                <b>{{ __('Remember Me') }}</b>
                            </label>
                            <span class="highlight">{{$errors->first('remember')}}</span>
                        </div> -->

                        <div class="col-lg-12 form-group text-right block2">
                            <label class="label-note">
                                <b><a href="{{route('forgotPassword')}}" class="text-white text-underline-decoration">Forgot password?</a></b>
                            </label>
                        </div>

                        <div class="m0-auto col-lg-12">
                            <button class="btn btn-primary bg-black text-decoration-none" name="doSubmit" id="doSubmit" value="doLogin" type="submit">Log In</button>
                        </div>

                       
                    <div class="col-12 text-end mt-4 mb-1">
                        <a href="#" data-toggle="modal" data-target="#exampleModalLong" class="text-underline-decoration text-light float-right">Need Help?</a>
                    </div>
         
                    </div>          
                </form>

              </div>
            </div>

           
           
           
          </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Need Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="left: -4%; margin-top: -4px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-end" style='color:black;'>
                <p>
                    Choosing "Keep me signed in" reduces the number of times you're asked to Sign-In on this device.
                </p>
                <p>
                    To keep your account secure, use this option only on your personal devices.
                </p>
                <p>
                    For further queries <br />
                    Contact us at <a href="tel:8072886122"> +91 80728 86122</a> <br />
                    Mail us at <a href="mailto:contact@ubidindia.com">contact@ubidindia.com</a>
                </p>
            </div>
        </div>
    </div>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
@endpush