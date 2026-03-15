@extends('partnerpanel.layout')

@push('PAGE_VENDOR_CSS')

<style>
    .chat-content p{
        color:#151515!important;
    }
  
    .user-chats{
        background-image: url('app-assets/images/logo/ubid-text-logo.png')!important;
    }
    .chat-app-window .chats .chat-body .chat-content {
        background-color:white!important;
    }
</style>
@endpush

@section('content')

 <div class="content-wrapper chat-application">
    <div class="content-body">
    <section class="parent-productlist">
                           
                                <div class="container">
                                    <div class="row">
                                       
                                        <div class="col-12 col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-1">
                                            <div class="content-area-wrapper">
                                                <div class="ticket-right">
                                                    <div class="content-wrapper">
                                                        <div class="content-header row"></div>
                                                        <div class="content-body">
                                                            <div class="body-content-overlay"></div>
                                                            <section class="chat-app-window">
                                            <div class="active-chat">
                                                <div class="chat-navbar">
                                                    <header class="chat-header">
                                                        <div class="d-flex align-items-center">
                                                            <div class="sidebar-toggle d-block d-lg-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu font-medium-5">
                                                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                                                </svg></div>
                                                            <!-- <div class="avatar avatar-border user-profile-toggle m-0 mr-1"><img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" alt="avatar" height="36" width="36"><span class="avatar-status-online"></span></div> -->
                                                            <h6 class="mb-0">TicketID: {{$ticket->ticket_id}} </h6>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="dropdown">
                                                               
                                                                @if($ticket->status==1)
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions" style="">
                                                                    <a class="dropdown-item" href="{{route('ppanel.ticketreopen',['id'=>$ticket->id])}}">Re-Open</a>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </header>
                                                </div>
                                                <div class="user-chats ps ps--active-y">
                                                    <div class="chats">
                                                    @foreach($ticket_details as $ticket_detail)
                                                        <div class="{{(auth()->user()->ref_id==$ticket_detail->comment_by)?'chat':'chat chat-left'}}">
                                                            <div class="chat-avatar"><span class="avatar box-shadow-1 cursor-pointer"><img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" alt="avatar" height="36" width="36"></span></div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    <p>{{$ticket_detail->comments}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    
                                                    </div>
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y" style="top: 0px; right: 0px; height: 28px;">
                                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y" style="top: 0px; height: 401px; right: 0px;">
                                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 233px;"></div>
                                                    </div>
                                                </div>
                                                <form class="chat-app-form" action="{{route('ppanel.postcomment',['id' =>$ticket->id ])}}" method="post">
                                                @csrf
                                                    <div class="col-lg-12 d-flex mr-1 form-send-message">
                                                        <input type="text" class="form-control message mr-1" name="sellerComment" id="sellerComment" placeholder="Type your message or use speech to text">
                                                        <button type="submit" class="btn btn-primary send waves-effect waves-float waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send d-lg-none">
                                                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                            </svg><span class="d-none d-lg-block">Send</span></button>
                                                </form>
                                            </div>
                                        </section>
                                                            
       
    <!-- Modern Horizontal Wizard -->
</div>

@stop

@push('PAGE_ASSETS_JS')
@endpush

@push('PAGE_SCRIPTS')
<script type="text/javascript">
    var EditTicket = function() {
        return { //main function to initiate the module
            init: function() {}
        }
    }();
    jQuery(document).ready(function() {
        EditTicket.init();
    });
</script>
@endpush