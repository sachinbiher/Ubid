@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .logo {
            position: absolute !important;
            left: 5px!important;
            top: 5px!important;
        }

        .first-3months {
            font-size: 25px!important;
            background: #1eda72bf!important;
            display: inline-block!important;
            padding: 2px 150px 8px 150px!important;
            border-radius: 10px!important;
        }

        .flex-container {
            display: flex!important;
            justify-content: center!important;
        }

        .flex-container>div {
            margin: 5px 15px!important;
        }

        .info-p {
            margin-top: 5px!important;
        }

        .button {
            border: none!important;
            color: black!important;
            text-align: center!important;
            text-decoration: none!important;
            display: inline-block!important;
            font-size: 20px!important;
            margin: 4px 2px!important;
            cursor: pointer!important;
            border-radius: 40px!important;
        }

        .button1 {
            padding: 5px 40px!important;
            background-color: #1eda72bf!important;
        }

        .button2 {
            padding: 5px 28px!important;
            background-color: #bb9116f0!important;
        }

        hr {
            height: 2px!important;
            background: black!important;
            /* width: 700px; */
        }

        .content {
            margin-top: 110px!important;
            margin-left: 130px!important;
        }

        .content h4 {
            font-size: 16px!important;
            color: #5b646d!important;
            border-bottom: 2px solid #d7dde3!important;
            width: 250px!important;
            margin-bottom: 1rem!important;
        }

        .pricing-list .cancel-price {
            text-decoration: line-through!important;
            font-size: 0.8rem!important;
        }

        .pricing-list .off-price {
            color: orangered!important;
            font-size: 0.8rem!important;
        }

        .pricing-list .price {
            font-size: 0.8rem!important;
        }

        #subscription-plans {
            width: 100px!important;
            border: 2px solid #d7dde3!important;
            padding: 5px!important;
            border-radius: 15px 0px 30px!important;
        }

        .bgFor-goPro {
            background-color: #bb9116f0!important;
            border: 2px solid #bb9116f0 !important;
        }

        .bgFor-goPro p {
            font-size: 12px!important;
            color: white!important;
        }

        .bgFor-goPro .subscribe-btn {
            background-color: aquamarine!important;
        }

        #subscription-plans .fa-check-circle {
            font-size: 24px!important;
            color: aquamarine!important;
        }

        #subscription-plans .fa-times-circle {
            font-size: 24px!important;
            color: red!important;
        }

        .subscribe-btn {
            font-size: 10px!important;
            border-radius: 10px!important;
            padding: 0px 5px!important;
            background: #ffffff!important;
            border: 1px solid #d7dde3!important;
            position: relative!important;
            top: 15px!important;
            left: -3px!important;
        }
    </style>
@endpush

@section('content')
<div class="logo">
    <a href="{{route('login')}}">
        <img src="{{url('app-assets\images\logo\UBID-Logo-1X.png')}}" alt="" height="60" /> &nbsp;
        <img src="{{url('app-assets\images\logo\ubid-text-logo.png')}}" alt="" height="50" />
    </a>
</div>

<div class="my-5">
    <div class="container">
        <!-- START section-->
        <div class="text-center">
            <h2 class="display-4 font-weight-normal">Join For FREE!</h2>
            <h4 class="mt-4 first-3months">Your first 3 months* are on us!</h4>
            <p style="font-size: 13px;">*First 3 months start from the day of your first bid.</p>

            <div class="flex-container">
                <div>
                    <img src="{{url('app-assets\images\logo\viewAll-projects.png')}}" alt="" width="70">
                    <p class="info-p">View all Projects</p>
                </div>

                <div>
                    <img src="{{url('app-assets\images\logo\BidProjects@2x.png')}}" alt="" width="60">
                    <p class="info-p">Place bids on unlimited Projects</p>
                </div>

                <div>
                    <img src="{{url('app-assets\images\logo\COntact@2x.png')}}" alt="" width="60">
                    <p class="info-p">Contact Customers Directly <br>
                        When bid is accepted</p>
                </div>
            </div>

            <div class="continue-btn">
            <form action="{{route('profile_review')}}" method="post" enctype="multipart/formdata">
                    {!! csrf_field() !!}
                <input type="hidden" class="form-control" name="id" id="id5" value="{{$vendorId}}">
                <button class="button button1">Continue &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-arrow-right" style="font-size: 20px;"></i></button>
            </form>
            </div>
            <div>
                <hr>
            </div>
            <div class="subscription-btn">
                <button class="button button2">Subscription Plans</button>
            </div>
        </div>
        <!-- END section-->

        <div class="my-3" style="margin-left: 12%;">
            <div class="row">
                <div class="col-md-2">
                    <div class="content listing">
                        <h4>View all projects</h4>
                        <h4>Place bids on unlimited Projects</h4>
                        <h4>View contact details of customers- <br>
                            <span style="color:red;">When Bid is accepted*</span>
                        </h4>
                        <h4>View contact details of customers- <br>
                            <span style="color:aqua;">Just place Bid & Contact!</span>
                        </h4>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="flex-container">
                        <!--1-->
                        <form action="{{route('profile_review')}}" method="post" enctype="multipart/formdata">
                                {!! csrf_field() !!}
                        <div>
                            <div class="text-center">
                                <div class="pricing-list">
                                    <span class="cancel-price">4500/-</span> <br>
                                    <span class="off-price">20% Off!</span> <br>
                                    <span class="price">3600/-* only</span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div id="subscription-plans">
                                        <p>3 months</p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-times-circle"></i></p>
                                        <input type="hidden" class="form-control" name="id" id="id1" value="{{$vendorId}}">
                                        <button type="submit" class="subscribe-btn">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                        <!--2-->
                        <form action="{{route('profile_review')}}" method="post" enctype="multipart/formdata">
                                {!! csrf_field() !!}
                        <div>
                            <div class="text-center">
                                <div class="pricing-list">
                                    <span class="cancel-price">9000/-</span> <br>
                                    <span class="off-price">30% Off!</span> <br>
                                    <span class="price">6300/-* only</span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div id="subscription-plans">
                                        <p>6 months</p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-times-circle"></i></p>
                                        <input type="hidden" class="form-control" name="id" id="id2" value="{{$vendorId}}">
                                        <button type="submit" class="subscribe-btn">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!--3-->
                        <form action="{{route('profile_review')}}" method="post" enctype="multipart/formdata">
                                    {!! csrf_field() !!}
                        <div>
                            <div class="text-center">
                                <div class="pricing-list">
                                    <span class="cancel-price">25000/-</span> <br>
                                    <span class="off-price">40% Off!</span> <br>
                                    <span class="price">15000/-* only</span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div id="subscription-plans" class="bgFor-goPro">
                                        <p>Go Pro! 12 months</p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <input type="hidden" class="form-control" name="id" id="id3" value="{{$vendorId}}">
                                        <button type="submit" class="subscribe-btn">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                        <!--4-->
                        <form action="{{route('profile_review')}}" method="post" enctype="multipart/formdata">
                                    {!! csrf_field() !!}
                        <div>
                            <div class="text-center">
                                <div class="pricing-list">
                                    <span class="cancel-price">18000/-</span> <br>
                                    <span class="off-price">35% Off!</span> <br>
                                    <span class="price">11700/-* only</span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div id="subscription-plans">
                                        <p>12 months</p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-check-circle"></i></p>
                                        <p><i class="fa fa-times-circle"></i></p>
                                        <input type="hidden" class="form-control" name="id" id="id4" value="{{$vendorId}}">
                                        <button type="submit" class="subscribe-btn">Subscribe</button>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5" style="position: absolute;right: 400px;">
            <p>*All Subscription plans are Excluding GST-18%</p>
        </div>
    </div>
</div>
@stop

@push('PAGE_ASSETS_JS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--font-awesome-->
@endpush

@push('PAGE_SCRIPTS')
<script>
    window.history.pushState(null, "", window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};
</script>
@endpush




@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')

   
   <style>
.spacer {
    margin: 0px 5px;
}

.child-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
    padding: 10px;
}

.main-content {
   
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    align-items: center;
}

.main-content h3,
.main-content h2 {
  font-size: 2.8rem;
    font-weight: 500;
    color: #000;
}

.main-content p {
  font-size: 1.4rem;
    color: #000;
}

.main-content .free-plan {
    text-decoration: none;
    color: black;
    border: 1px solid #adb5bd;
    border-radius: 5rem;
    padding: 0px 15px;
    margin: 10px 0;
    background: #2eeab7;
}

.main-content .power-img {
  width: 200px;
    position: absolute;
    top: -36px;
    right: -100px;
    z-index: -1;
}

/*radios*/
/* Hide the browser's default radio button */
.form-check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

[type="radio"]:checked+label,
[type="radio"]:not(:checked)+label {
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #000;
}

[type="radio"]:checked+label:before,
[type="radio"]:not(:checked)+label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}

[type="radio"]:checked+label:after,
[type="radio"]:not(:checked)+label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #2eeab7;
    position: absolute;
    top: 3px;
    left: 3px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}

[type="radio"]:not(:checked)+label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}

[type="radio"]:checked+label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}

/* cards */
.description {
  height: 50px;
    display: flex;
    align-items: end;
    justify-content: center;
    text-align: center;
    margin-bottom: 4px;
    font-size: 16px;
    color: #000;
}
.card
{
  padding: 12px 12px 0;
}
.card-blue {
    background: linear-gradient(20deg, #5809a0, #a8c0ff)!important;
    border: none;
    border-radius: 0;
}

.price-o {
  font-size: 13px;
    margin-left: 46px;
    margin-top: 5px;
    text-decoration: line-through;
    color: #000;
}

.card-blue .card-content .col-12>a {
    font-size: 11px;
    text-decoration: underline;
}

.subscribe-btn {
    position: relative;
    top: 10px;
    border: 1px solid #adb5bd;
    background: #fff;
    font-size: 14px;
    color: #000;
    text-decoration: none;
    outline: none;
    padding: 3px 20px;
    border-radius: 30px;
}

.cost {
  text-align: center;
    color: #fff;
    font-size: 28px;
    display: revert;
    position: relative;
}

/* 
.month::before {
    content: 'mo';
    font-size: 10px;
    position: absolute;
    top: 23%;
    left: 59%;
    color: #fff;
} */

.card-content .col-12>a {
    display: block;
    font-size: 14px;
    margin: 8px 0;
    color: #fff;
    text-decoration: underline;
}

/* 2nd card */
.orange-bg {
  background-image: url('./app-assets/images/subscription-page/orange_bg.png')!important;
  background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 255px;

}
.blue-bg
{
  background-image: url('./app-assets/images/subscription-page/blue_bg.png')!important;
  background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 255px;
}
.card-content
{
  padding-top: 45px;
}
.card
{
  padding:0!important;
  border:0 !important;
}
.cost-goldcard2 {
    font-size: 1.2rem;
    color: #fff;
    margin-right: 5px;
    margin-bottom: 0;
}

.price2 {
    text-decoration: none;
}

.card2-month::before {
    left: 62%;
    top: 21%;
}

/* 3nd & 4th card */
.cost-bluecard2 {
    font-size: 1.2rem;
    text-decoration: line-through;
    color: #fff;
    margin-right: 5px;
    margin-bottom: 0;
}

.price-active {
    height: 40px;
    position: relative;
}

.yearly-subscription {
  font-size: 9px !important;
    margin-right: 0;
    margin-top: 0;
    color:#fff!important;
}

.card3-month::before {
    top: 22%;
    left: 82%;
}

.card4-month::before {
    left: 87%;
    top: 19%;
}

/*END cards */

.widget-line {
    position: relative;
}

.widget-line::before {
    content: '';
    /* background: #b35b25; */
    background-image: url('./app-assets/images/subscription-page/ellipse.png');
    position: absolute;
    top: 40px;
    background-size: contain;
    left: -2px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
}

.widget-line p {
    position: absolute;
    top: 80px;
    left: -80px;
    transform: rotate(270deg);
}

.widget-line .yearly {
    position: absolute;
    top: 65px;
    left: -65px;
}

.widget-line::after {
    content: "";
    position: absolute;
    height: 315px;
    width: 1px;
    z-index: -1;
    background: #00000099;
    opacity: 0.2;
    top: 20%;
    left: 8px;
}

.w-none::after {
    content: none;
}

@media (max-width:600px) {
    .main-content p {
        font-size: 1rem;
    }

    .main-content h2 {
        font-size: 1.8rem;
    }

    .main-content .power-img {
        position: absolute;
        left: 80px;
        top: -40px;
        width: 150px;
    }

    .description {
        font-size: 15px;
        margin-left: 30px;
    }

    .card-blue {
        width: 130px;
    }

    .card-gold {
        width: 160px;
    }

    .widget-line::before {
        left: 16px;
    }

    .widget-line::after {
        left: 24px;
    }

    .widget-line p {
        transform: rotate(270deg);
        position: absolute;
        top: 65px;
        left: -30px;
    }

    .widget-line .yearly {
        position: absolute;
        top: 60px;
        left: -20px;
    }
}

@media (max-width:1024px) {
    .main-content .power-img {
        position: absolute;
        top: -30px;
        right: 100px;
    }
}

@media (max-width:768px) {
    .main-content .power-img {
        width: 170px;
        height: 170px;
        float: right;
        top: -30px;
        position: absolute;
        right: 10px;
    }

    .widget-line::after {
        height: 320px !important;
        top: 50px !important;
    }
}
.navbar-brand img
{
  width:211px;
}
.month
{
  position: absolute;
    font-size: 12px;
    top: 20px;
    right: 0;
}
body
{
  background:#fff !important
}
.cost-first .month
{
  right: 48PX;
}
.cost-second .month
{
 
    right: 66px;

}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!--font-awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')
<div class="col-xl-8 col-lg-6">
        <div class="pt-2">
            <a class="navbar-brand" href="#">
                <img src="./app-assets/images/UBID-logo.png">
            </a>
        </div>
    </div>

    <div class="">
        <div class="main-content col-lg-6 offset-lg-3">
            <h3>UBID is FREE!</h3>
            <p>As long as you want to View all Projects!</p>
            <form  method="post" enctype="multipart/formdata">
                    {!! csrf_field() !!}
                <input type="hidden" class="form-control" name="id" id="id5" value="{{$vendorId}}">
                <!-- <button class="button button1">Continue &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-arrow-right" style="font-size: 20px;"></i></button> -->
                    <a href="{{route('profile_review')}}" class="free-plan">Continue with Free Plan!</a>
            </form>
            
          <div class="position-relative">

          <h2 style="z-index: 3">To have more Power!</h2>
            <p>Subscribe to anyone of our plans!</p>
            <div class="power-img" >
                <img src="{{url('app-assets\images\subscription-page\Power_Illustration.png')}}" alt="" />
            </div>
</div>
            <div class="row">
                <div class="col-6">
                    <!-- Default inline 1-->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1" checked />
                        <label class="form-check-label" for="inlineRadio1">
                            Monthly</label>
                    </div>
                </div>
                <div class="col-6">
                    <!-- Default inline 2-->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2" />
                        <label class="form-check-label" for="inlineRadio2"> Yearly</label>
                    </div>
                </div>
            </div>
            <div class="main-content mt-3">
                <h3>34% OFF</h3>
                <p>on All Subscriptions!</p>
            </div>

            <!--plans-->
            <div class="row justify-content-center" style="width: 100%">
                <div class="widget-line col-lg-1">
                    <p>MONTHLY</p>
                </div>
                <div class="col-4 blue-bg">
                    <!-- <h5 class="description">Beginner</h5> -->
                    <div class="">
                    <div class="">
                        <div>
                          
                            <div class="price-active">
                            <h6 class="price-o">1500/-*</h6>
                                <h4 class="cost cost-first">990/-*  <span class="month">mo</span></h4>
                               
                            </div>
                        </div>
                        <div class="card-content text-center">
                            <div class="col-12">
                                <a href="#">View all projects</a>
                                <a href="#">Place Unlimited Bids</a>
                                <a href="#">Contact Customers-When Bid is accepted</a>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModalLong"  class="subscribe-btn">Subscribe</button>
                        </div>
                    </div> </div>
                </div>
                <div class="col-1"></div>
                <div class="col-5 orange-bg">
                    <!-- <h5 class="description">
                        RECOMMENDED <br />
                        Go-PRO
                    </h5> -->
                    <div class="">
                    <div class="">
                        <div>
                            <h6 class="price-o price2">2500/-*</h6>
                            <div class="price-active">
                                <h4 class="cost cost-second">1650/-*    <span class="month">mo</span></h4>
                             
                            </div>
                        </div>
                        <div class="card-content text-center">
                            <div class="col-12">
                                <a href="#">View all projects</a>
                                <a href="#">Place Unlimited Bids</a>
                                <a href="#">Directly <br />
                                    Contact Customers</a>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModalLong"  class="subscribe-btn">Subscribe</button>
                        </div>
                    </div></div>
                </div>
            </div>

            <div class="row justify-content-center mt-5" style="width: 100%">
                <div class="widget-line w-none col-lg-1">
                    <p class="yearly">YEARLY</p>
                </div>
                <div class="col-4 blue-bg">
                    
                    <div class="">
                      <div class="">

                        <div>
                            <h6 class="price-o">1500/-*</h6>
                            <div class="price-active">
                                <h4 class="cost text-right">990/-* <span class="month">mo</span>   <p class="yearly-subscription">Yearly Subscription</p></h4>
                             
                             
                            </div>
                        </div>
                        <div class="card-content text-center">
                            <div class="col-12 px-1">
                                <a href="#">View all projects</a>
                                <a href="#">Place Unlimited Bids</a>
                                <a href="#">Contact Customers-When Bid is accepted</a>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModalLong"  class="subscribe-btn">Subscribe</button>
                        </div>
                    </div> </div>
                </div>
                <div class="col-1"></div>
                <div class="col-5 orange-bg">
                    <!-- <h5 class="description">
                        RECOMMENDED <br />
                        Go-PRO
                    </h5> -->
                    <div class=" ">
                        <div>
                            <h6 class="price-o price2">2200/-*</h6>
                            <div class="price-active">
                                <h4 class="cost text-right">1452/-* <span class="month">mo</span>    <p class="yearly-subscription">Yearly Subscription</p></h4>
                               
                             
                            </div>
                        </div>
                        <div class="card-content text-center">
                            <div class="col-12 px-1">
                                <a href="#">View all projects</a>
                                <a href="#">Place Unlimited Bids</a>
                                <a href="#">Directly <br />
                                    Contact Customers</a>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModalLong"  class="subscribe-btn">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--END plans-->
        </div>
    </div>
    
@stop

@push('PAGE_ASSETS_JS')

@endpush

@push('PAGE_SCRIPTS')
<script>
    function prev(){
		document.getElementById('slider-container').scrollLeft -= 270;
}
function next(){
		document.getElementById('slider-container').scrollLeft += 270;
}
</script>

    <!-- Bootstrap JS-->
   
@endpush