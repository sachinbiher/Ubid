<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow fixed-top">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ml-auto">
            <!-- <li class="nav-item dropdown dropdown-notification mr-25">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                <i class="ficon" data-feather="settings"></i>
                </a>
            </li> -->
            <li class="nav-item dropdown dropdown-notification mr-25">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">{{$notification_count}}</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header" style="display:none;">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        @foreach($notifications as $notification)
                        <a class="d-flex" href="{{route('notifications')}}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading" style="margin-top:3%;"><span class="font-weight-bolder">{{$notification->title}}</span></p>
                                </div>
								<p class="media-heading" style="color: #6E6B7B;margin-bottom: 0;margin-top:1.5%;line-height: 1.2;"><small class="notification-text" style="margin-bottom: .5rem;font-size: smaller;color: #626271;">{{date('d M, Y h:i A', strtotime($notification->created_at))}}</small></p>
                            </div>
                        </a>
                        @endforeach
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{route('notifications')}}">Read all notifications</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">Admin</span><span class="user-status">Admin</span></div>
                    <span class="avatar"><img class="round" src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <!-- <a class="dropdown-item" href="#"><i class="mr-50" data-feather="user"></i> Profile</a> -->
                    <a class="dropdown-item" href="{{route('changePassword')}}"><i class="mr-50" data-feather="unlock"></i> Change Password</a>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="mr-50" data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="nav-header d-flex">
<div class="nav-control">
        <div class="hamburger">
        <a class="nav-link menu-toggle" href="javascript:void(0);">
            <i data-feather="menu"></i>
        </a>
        </div>
    </div>
    <a href="{{route('dashboard')}}" class="brand-logo ">
    <span class="logo-text text-dark"><img src="{{url('app-assets/images/logo/logo.png')}}"></span>
    </a>
    
</div>
