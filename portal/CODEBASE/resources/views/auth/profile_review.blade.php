@extends('layouts.auth') @push('PAGE_ASSETS_CSS') <style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    html body {
        background-color: white !important;
    }

    @font-face {
        font-family: Century Gothic;
        src: url('./GOTHIC.TTF');
    }

    body {
        font-family: Century Gothic;
        color: #000 !important;
        font-weight: 600;
    }

    .section {
        min-height: 100vh;
        width: 100%;
    }

    .content {
        text-align: center;
    }

    .child-content h1 {
        font-size: 3.2rem;
        font-weight: 600;
    }

    .small-heading {
        background: #eaab6fb5;
        display: inline-block;
        padding: 5px 100px;
        margin: 10px auto;
        border-radius: 15rem;
    }

    .small-heading h4 {
        font-weight: 600;
    }

    .small-info {
        margin: 14px 0px 25px;
    color: #000000c2;
    font-weight: 600;
    font-size: 16px;
    }

    .small-info>a {
        color: #000000c2;
        text-decoration-color: #adb5bd;
    }

    .inner-logo {
        position: absolute;
        top: -30px;
    left: 6px;
    width: 25px;
    height: 29px;
    }

    .v-row {
        display: flex;
        justify-content: center;
        align-items: center;
        vertical-align: middle;
    }

  


    .para-two {
        text-align: left;
    font-size: 14px;
    color: #000;
    font-weight: 400;
    margin: 10px 0px;
    }

    .button {
        position: absolute;
        bottom: -8px;
    }

    button[type="button"] {
        font-size: 20px;
        border: 0.01px solid #948787;

        padding: 5px 50px;
        border-radius: 5rem;
        background: #2eeab7;
        color: #000;
        outline: none;
    }

    @media (max-width:600px) {
        .child-content h1 {
            font-size: 2.5rem;
        }

        .small-heading {
            padding: 5px 10px;
            margin: 0;
        }

        .small-info {
            font-size: 0.8rem;
        }

        .inner-logo {
            position: absolute;
            left: 5%;
        }

        .row-position {
            position: absolute;
            left: 10%;
            width: 80%;
        }

        .row2-position {
            position: absolute;
            top: 45%;
            left: 10%;
            width: 90%;
        }

        .row3-position {
            position: absolute;
            left: 10%;
            top: 80%;
        }

        .row3-position .para-two {
            font-size: 11px;
        }
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
 <section class="section">
    <div class="container">
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('login')}}">
                    <img src="{{url('app-assets/images/UBID-Logo-1X@2x.png')}}" alt="" width="50" />
                    <img src="{{url('app-assets/images/UBID Text-1x@2x.png')}}" alt="" width="100" />
                </a>
            </div>
        </nav>
        <div class="content">
            <div class="child-content">
                <h1 style="color:#151515!important;">Congratulations!</h1>
                <div class="small-heading">
                    <h4 style="color:#151515!important;">Your account is under review</h4>
                </div>
                <p class="small-info"> While we approve your account, please go head and start creating your stunning profile! </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 offset-lg-4 registrationdetails-div" style="background-repeat:no-repeat;background-image:url({{url('app-assets/images/zigzag-shape.png')}})">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{url('app-assets/images/UBID-Logo-1X@2x.png')}}" alt="" width="40" height="45" class="inner-logo" /> @if($vendor_detail->photo !='') 
                        <img src="{{$vendor_detail->photo}}" class="rounded-circle prof-img" width="130" height="130"> @else <img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" class="rounded-circle prof-img" width="130" height="130"> @endif
                    </div>
                    <div class="col-lg-8 main-profdet">
                        <ul class="profile-details">
                            <li><span>Name</span>{{$vendor_detail->company}}</li>
                            <li><span>Email</span>{{$vendor_detail->email}}</li>
                            <li><span>Mobile</span>{{$vendor_detail->mobile}}</li>
                      
                    </div>
                    <div class="col-12 services-selectlist">
                        <h5>Services</h5>
                        <form>
                            <div class="row"> @php $vendors = json_decode($vendor_detail->services); @endphp @foreach($vendors as $vendor_service) <div class="col-6">
                            @php $category_val = App\Models\Category::where('id',$vendor_service)->first(); @endphp
                              <p>   {{$category_val->name}}</p>
                                </div> @endforeach </div>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <p class="para-two"> Login credentials have been mailed to you. Please check your email for username &amp; password. You will be required to create a new password after Log In </p>
                    </div>
                    <div class="btn-formposition">
                <button type="button" onclick="location.href='{{ route('login') }}'">Log In</button>
            </div>
                </div>
            </div>
           
        </div>
    </div>
</section> @stop @push('PAGE_ASSETS_JS') @endpush @push('PAGE_SCRIPTS') <script>
</script> @endpush