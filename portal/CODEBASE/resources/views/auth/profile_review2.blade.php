@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')
<style>
   .highlight {
      position:inherit !important;
      color:red;
   }
   .m-5 {
    margin: 4rem!important;
}
.justify-content-center {
    justify-content: center!important;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -1rem;
    margin-left: -1rem;
}
.align-items-center {
    align-items: center!important;
}

a, a:hover {
    text-decoration: none;
}
a {
    color: #7367f0;
    background-color: transparent;
}
.w-600 {
    width: 600px;
}
.bg-white {
    background-color: #fff!important;
}
.bg-white {
    background-color: #fff!important;
}
.ml-auto, .mx-auto {
    margin-left: auto!important;
}
.mr-auto, .mx-auto {
    margin-right: auto!important;
}
.p-3 {
    padding: 3rem!important;
}
.avatar.avatar-xl {
    font-size: 1.5rem;
}

.avatar {
    white-space: nowrap;
    background-color: #c3c3c3;
    border-radius: 50%;
    position: relative;
    cursor: pointer;
    color: #fff;
    display: inline-flex;
    font-size: 1rem;
    text-align: center;
    vertical-align: middle;
    font-weight: 600;
}
.avatar.avatar-xl img {
    width: 100px;
    height: 100px;
}

.avatar img {
    border-radius: 50%;
}
html body p {
    line-height: 1.5rem;
}
p {
    margin-top: 0;
    margin-bottom: 1rem;
}
b, strong {
    font-weight: 600;
}
.mt-2, .my-2 {
    margin-top: 1.5rem!important;
}
.section-label {
    font-size: .85rem;
    color: #626271;
    text-transform: uppercase;
    letter-spacing: .6px;
}
.mb-75, .my-75 {
    margin-bottom: .75rem!important;
}
.mt-1, .my-1 {
    margin-top: 1rem!important;
}
.card-title {
    margin-bottom: 1.5rem;
}
.mt-2, .my-2 {
    margin-top: 1.5rem!important;
}
.badge.badge-light-primary {
    background-color: rgba(115,103,240,.12)!important;
    color: #7367f0!important;
}

.badge {
    color: #fff;
}
.pb-1, .py-1 {
    padding-bottom: 1rem!important;
}
.pt-1, .py-1 {
    padding-top: 1rem!important;
}
.mr-1, .mx-1 {
    margin-right: 1rem!important;
}
.badge {
    display: inline-block;
    padding: .3rem .5rem;
    font-size: 85%;
    font-weight: 600;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .358rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,background 0s,border 0s;
}
.w-600 {
    width: 600px;
}
.badge-light-primary{
    margin-bottom: 10px!important;
}
.bg-success {
    background-color: #28c76f!important;
}
.bg-success {
    background-color: #28c76f!important;
}
.text-white {
    color: #fff!important;
}
.ml-auto, .mx-auto {
    margin-left: auto!important;
}
.mr-auto, .mx-auto {
    margin-right: auto!important;
}
.p-1 {
    padding: 1rem!important;
}
.mt-2, .my-2 {
    margin-top: 1.5rem!important;
}
.align-items-center {
    align-items: center!important;
}
.feather {
    font-family: feather!important;
    speak: none;
    font-style: normal;
    font-weight: 400;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

svg {
    overflow: hidden;
}
img, svg {
    vertical-align: middle;
}
.m-0 {
    margin: 0!important;
}
body {
    margin: 0;
    font-family: Montserrat,Helvetica,Arial,serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.45;
    color: #151515;
    text-align: left;
    background-color: #f8f8f8;
}
 .details {
    color: #151515;
} 
.planDetails{
    color: white;
}
#toast-container .toast-success{
    background-color: #28c76f!important;
}
#toast-container .toast-error{
    background-color: #ea5455!important;
}
*{
   -webkit-box-sizing: border-box;
   box-sizing: border-box;
   margin: 0;
   padding: 0;
   }
   .planDetails1{
       color: #151515!important;
   }
   .pending{
        width: 175px;
        height: 213px;
        display: block;
        position: relative
    }
   .pending::after {
        content: "";
        width: 80px;
        height:80px;
        opacity: 0.3;
        background: url(app-assets\images\pending.png) no-repeat;
        position: absolute;
        bottom: 1;
        right: 0;
    }
</style>
@endpush

@section('content')
<section>
    <div class="row justify-content-center m-5">
        <a class="brand-logo align-items-center" href="{{route('login')}}">
            <img src="app-assets\images\logo\logo.png" alt="brand-logo" height="68" />
            <!-- <img src="app-assets\images\logo\logo.png" class="ml-1" alt="brand-logo" height="40" /> -->
        </a>
    </div>
    <!-- <div class="pending">
        <img class="pending" id="pending" src="{{url('app-assets\images\pending.png')}}" alt="">
    </div> -->
    <div class="bg-white p-3 w-600 mx-auto row">
        <div class="col-md-3">
            <div class="avatar avatar-xl">
                @if($vendor_detail->photo !='')
                <img src="{{$vendor_detail->photo}}" class="round img-fluid" id='output' alt="Card image">
                @else
                <img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" class="round img-fluid" id='output' alt="Card image">
                @endif
            </div>
        </div>
       
        <div class="col-md-9">
            <p class="details"><b>Name : </b>{{$vendor_detail->first_name}} {{$vendor_detail->last_name}}</p>
            <p class="details"><b>Email : </b>{{$vendor_detail->email}}</p>
            <p class="details"><b>Mobile Number : </b>+91 {{$vendor_detail->mobile}}</p>
            <!-- <p><b>Company Name : </b>Name of company (If Provided)</p> -->
        </div>
        <div class="col-md-12 mt-2">
            <div class="design-group">
                <h6 class="section-label">Company Name / Name</h6>
                <h4 class="card-title mt-1 mb-75">{{$vendor_detail->company}}</h4>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="design-group">
                <h6 class="section-label">Services</h6>
                @php
                $vendors = json_decode($vendor_detail->services); 
                @endphp
                @foreach($vendors as $vendor_service)
                <div class="badge badge-light-primary mr-1 py-1">{{$vendor_service}}</div>
                @endforeach
            </div>
            <p class="m-0 planDetails1">Your login details have been sent to your registered email address.<br> To login <b style="color:#151515;font-weight:800;"><a href="{{route('login')}}"> Click Here !</a></b></p>
        </div>
    </div>
    <div class="bg-success text-white p-1 mt-2 w-600 mx-auto row align-items-center">
        <div class="col-md-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-aperture"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
        </div>
        <div class="col-md-9">
            <b>Free plan</b>
            <p class="m-0 planDetails">You've Subscribed to 3 Months free Plan</p>
            <p class="m-0 planDetails">Thank you for Registering with us. We will get back to you shortly.</p>
            
        </div>
    </div>
</section>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script>
window.history.pushState(null, "", window.location.href);

window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};
</script>
@endpush