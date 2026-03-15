@extends('layouts.app')

@push('PAGE_VENDOR_CSS')
<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/bs-stepper.min.css')}}">
@endpush

@push('PAGE_ASSETS_CSS')
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-body">
        <section class="modern-horizontal-wizard profile-style2">
            <div class="bs-stepper-content">
                <section>
                    <div class=" notification-list ">
                        <div class="col-lg-8 col-sm-8 col-xs-8 col-xl-8 offset-lg-2">
                            <div class="row push-row">
                                <div class="d-flex push-notifications vertical-align-middle float-right align-items-center"> <span class="font-16 font-weight-600 push-text">
                                Push Notifications
                            </span>
                                    <div class="toggle-main">

                                        <input type="checkbox" id="toggle-button-checkbox">
                                        <label class="toggle-button-switch" for="toggle-button-checkbox"></label>
                                        <div class="toggle-button-text">
                                            <div class="toggle-button-text-on">Yes</div>
                                            <div class="toggle-button-text-off">No</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <ul class="p-a0">

                                <li class="scrollable-container media-list ps">
                                @if($notificationsCount == 0)
                                    <p style="text-align:center;">No Notifications Available!</p>
                                @else
                                @foreach($notifications as $notification)
                                    <a class="d-flex" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start notification-block">
                                            <div class="media-left">
                                                <div class="avatar"><img src="{{asset('seller/images/avatars/avatar-s-11.jpg') }}" alt="avatar" width="32" height="32"></div>
                                            </div>
                                            <div class="media-body">
                                                <p class="media-heading"><span class="font-weight-bolder">{{$notification->title}}</p><small class="notification-text">{{$notification->content}}</small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                @endif
                                    
                                </li>
                            </ul>
                            <div class="col-xl-12 col-lg-12">

                                <nav aria-label="Page navigation">
                                @if($notificationsCount == 0)

                                @else
                                    <!-- <ul class="pagination justify-content-end mt-2">
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                        <li class="page-item active"><a class="page-link" href="javascript:void(0);">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">5</a></li>
                                    </ul> -->
                                @endif
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
        init: function () {


        }
    }
}();

jQuery(document).ready(function() {
    Notifications.init();
});
</script>
@endpush