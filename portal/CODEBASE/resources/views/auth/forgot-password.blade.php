@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    
    /*-- start here--*/

a{
    text-decoration: none;
}

.logo{
    margin: 25px 80px;
}
.logo img{
    height: 60px;
}

@media (max-width:768px){
    .logo{
        margin: 25px 20px !important;
    }
    .logo img{
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
    padding: 30px;
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

 input {
    width: 100%;
    border: none;
    background: #fff;
    margin: 0px 0 5px 0;
    padding: 5px;
    height: 36px;
    font-size: 13px;
    border-radius: 0;
}


.btn-primary {
    font-size: 16px;
    color: #fff;
    padding: 9px 25px;
    border-radius: 30px;
    background: #000!important;
    margin-left: 5px;
    border: none;
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

    .element-main {
        width: 30%;
    }
}

@media(max-width:1024px) {
    .element-main {
        width: 40%;
    }
}

@media(max-width:768px) {
    .element-main {
        width: 49%;
    }

    .elelment h2 {
        font-size: 2rem;
    }

    .element-main {
        width: 60%;
    }

    .element-main h1 {
        font-size: 2rem;
    }
}

@media(max-width:640px) {}

@media(max-width:480px) {
    .element-main {
        width: 80%;
        padding: 3rem 1.5rem;
    }

    .copy-right {
        margin: 5rem 0rem 2rem 0rem;
    }

    .copy-right p {
        font-size: 0.9rem;
    }
    #otp-form input{
        width: 8% !important;
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
#otp-form{
    max-width: 550px;
  margin: 25px 10px 0;
}
#otp-form input{
    display: inline-block;
    text-align: center;
    font-size: 20px;
    border: solid 1px #000;
    outline: none;
    width: 11%;
    transition: all 0.2s ease-in-out;
    border-radius: 3px;
  }
  h1 i {
    display: table !important;
    background: #fff;
    border-radius: 50%;
    margin: 0 auto 15px;
    font-size: 29px !important;
    color: #b67e54;
    width: 60px;
    height: 60px;
    line-height: 60px !important;
}
  #otp-form input:focus{
    border-color: #2eeab7;
    box-shadow: 0 0 5px #2eeab7 inset;
  }

#toast-container .toast-success{
    background-color: #28c76f!important;
}
#toast-container .toast-error{
    background-color: #ea5455!important;
}
h4
{       width: 100%;
    font-size: 15px;
    margin-top: 20px;
    margin-bottom: 14px !important;
    color: #000;}

   .text-end p
{
  font-size: large !important;
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
<div class="container-fluid">
        <div class="col-xl-8 col-lg-6">
          <div class="py-2">
            <a class="navbar-brand" href="{{route('login')}}">
              <img src="./app-assets/images/loginpage/UBID-Logo-1X@2x.png" alt="" width="65" />
              <span class="spacer"></span>
              <img src="./app-assets/images/loginpage/UBID Text-1x@2x.png" alt="" width="130" />
            </a>
        </div>
</div>
	<!--element start here-->
	<div class="row elelment">
	
		<div class="col-lg-4 offset-lg-4 element-main">
    
			<h1 class="title-head text-white"><i class="fa fa-lock fa-4x"></i>Forgot Password</h1>
			<h4 class='text-end' > Enter your email address below to reset password.</h4>
			<form class="auth-forgot-password-form auth-form-div" id="auth-forgot-password-form" action="{{route('forgotPassword')}}" method="post">
			
            {!! csrf_field() !!}

            <input id="email" type="text" name="email" placeholder="Your e-mail address" required>
            <div class="col-lg-12 mt-2">
				<button class="btn btn-primary bg-black text-decoration-none" type="submit" name="doSubmit" id="doSubmit" value="doSubmit">Reset my Password</button>
             </div>

			</form>
            <!-- <p><a class="button1" href="{{route('login')}}">Log In</a></p> -->
		</div>
	</div>
    
	<div class="copy-right">
		<p>© 2021 UBID. All rights reserved.</p>
	</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
var ForgotPassword = function () {
    return { //main function to initiate the module
        init: function () {
            $('.auth-forgot-password-form').validate({
                onkeyup: function (element) {
                    $(element).valid();
                },
                onfocusout: function (element) {
                    $(element).valid();
                },
                rules: {
                    'email': {
                        required: true,
                        email: true
                    }
                }
            });
        }
    }
}();

jQuery(document).ready(function() {
    ForgotPassword.init();
});
</script>

@endpush