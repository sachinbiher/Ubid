@extends('layouts.app')

@push('PAGE_VENDOR_CSS')
<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/bs-stepper.min.css')}}">
@endpush

@push('PAGE_ASSETS_CSS')
<style>
    .pull-right {
    float: right!important;
}
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-body">
        <section class="modern-horizontal-wizard profile-style2">
            <div class="bs-stepper-content">
                <section>
                    <div class=" notification-list ">
                        <div class="col-lg-12">
                            <div class="row push-row">
                                <div class="d-flex push-notifications vertical-align-middle float-right align-items-center"> <span class="font-16 font-weight-600 push-text">
                                <!-- Push Notifications -->
                            </span>
                                    <div class="toggle-main">

                                        <!-- <input type="checkbox" id="toggle-button-checkbox">
                                        <label class="toggle-button-switch" for="toggle-button-checkbox"></label> -->
                                        <!-- <div class="toggle-button-text">
                                            <div class="toggle-button-text-on">Yes</div>
                                            <div class="toggle-button-text-off">No</div>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                            <ul class="p-a0">

                                <li class="scrollable-container media-list ps">
                                @if($notificationsCount == 0)
                                    <p style="text-align:center;">No Notifications Available!</p>
                                @else
                                @foreach($notifications as $notification)
                                    <a class="d-flex">
                                        <div class="media d-flex align-items-start notification-block">
                                            <div class="media-left">
                                                <div class="avatar"><img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" alt="avatar" width="32" height="32"></div>
                                            </div>
                                            <div class="media-body">
                                                <p class="media-heading"><span class="font-weight-bolder">{{$notification->title}}</p>
                                                <!-- <span class="text-off pull-right"><small>{{date('d M, Y', strtotime($notification->created_at))}}</small></span> -->
                                                <small class="notification-text">{{$notification->content}}</small>
                                            </div>
                                            <p class="media-heading" style="color: #6E6B7B;margin-bottom: 0;line-height: 1.2;"><small class="notification-text" style="margin-bottom: .5rem;font-size: smaller;color: #B9B9C3;">{{date('d M, Y', strtotime($notification->created_at))}}</small></p>
                                        </div>
                                    </a>
                                @endforeach
                                @endif    
                                </li>
                            </ul>
                            <div class="col-xl-12 col-lg-12">

                                <nav aria-label="Page navigation">
                                
                                </nav>
                            </div>
                        </div>
                    </div>
                </section>
                   
            </div>
        </section>
        <!-- Modern Horizontal Wizard -->
    </div>
</div>
@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
var Notifications = function () {
    return { //main function to initiate the module
        init: function () {}
    }
}
jQuery(document).ready(function() {
    Notifications.init();
});
</script>
@endpush