@extends('layouts.app')

@push('PAGE_VENDOR_CSS')
<style>
    .chat-content p{
        color:#151515!important;
    }
    .content-body{
        min-height:500px;
    }
    .user-chats{
        background-image: url('app-assets/images/logo/ubid-text-logo.png')!important;
    }
    .chat-app-window .chats .chat-body .chat-content {
        background-color:white!important;
    }
    .chat-app-window .active-chat {
    height: 100%!important;
    }
    .chat-application .chat-app-window .user-chats {
    height: 100%!important;
    }
    .chat-app-window .chat-app-form {
    margin-top: -150px;
    }
</style>
@endpush

@section('content')
<br><br>
 <div class="content-wrapper chat-application">
    <div class="content-body">
        <section class="modern-horizontal-wizard profile-style2">
              <div class="bs-stepper-content">
                <div class="container">
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
                                                            <h6 class="mb-0">TicketID: {{$ticket->ticket_id}}  </h6>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="dropdown">
                                                                <button class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-medium-2" id="chat-header-actions">
                                                                        <circle cx="12" cy="12" r="1"></circle>
                                                                        <circle cx="12" cy="5" r="1"></circle>
                                                                        <circle cx="12" cy="19" r="1"></circle>
                                                                    </svg>
                                                                </button>
                                                                @if($ticket->status==0 || $ticket->status==2)
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions" style="">
                                                                    <a class="dropdown-item" href="{{route('ticket.close',['id'=>$ticket->id])}}">Resolve</a>
                                                                </div>
                                                                @elseif($ticket->status==1)
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions" style="">
                                                                    <a class="dropdown-item" href="{{route('ticket.reopen',['id'=>$ticket->id])}}">Re-Open</a>
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
                                                            <!-- <div class="chat-avatar"><span class="avatar box-shadow-1 cursor-pointer"> -->
                                                            <!-- <img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" alt="avatar" height="36" width="36"></span></div> -->
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    <p>{{$ticket_detail->comments}}</p>
                                                                
                                                                    <p class="media-heading" style="color: #6E6B7B;margin-bottom: 0;line-height: 1.2;"><small class="notification-text" style="margin-bottom: .5rem;font-size: smaller;color: #32323d;">{{date('d M, Y', strtotime($ticket_detail->created_at))}}</small></p>
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
                                                <form class="chat-app-form" action="{{route('ticket.postComment',['id' =>$ticket->id ])}}" method="post">
                                                @csrf
                                                    <div class="input-group input-group-merge mr-1 form-send-message">
                                                        <input type="text" class="form-control message" name="sellerComment" id="sellerComment" placeholder="Type your message or use speech to text">
                                                        <button type="submit" class="btn btn-primary send waves-effect waves-float waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send d-lg-none">
                                                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                            </svg><span class="d-none d-lg-block">Send</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- Modern Horizontal Wizard -->
</div>
<!-- </div> -->
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