<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
         <li class="nav-item">
            <a class="d-flex align-items-center @if($activeMenu=='Testimonials') active @endif  "  href="{{route('ppanel.testimonials')}}">
            <!-- @if($vendor->status==1 && $subscriptiontype->period_months <> '0' ) href="{{route('ppanel.testimonials')}}"  @elseif($vendor->status==1 && $subscriptiontype->period_months == '0' ) href="javascript:changestatus(4);" @else href="javascript:changestatus(1);"  @endif > -->
                <div class="d-flex flex-column mx-auto">
                    <i data-feather="list"></i><span class="menu-title text-truncate"
                        data-i18n="Calendar"></span>
                    <p>Testimonials</p>
                </div>
            </a>
        </li>
          <!-- href="{{route('ppanel.placebids')}}" > -->
        <li class="nav-item">
            <a class="d-flex align-items-center @if($activeMenu=='Place Bids') active @endif"  
          
             @if($vendor->status==1) href="{{route('ppanel.placebids')}}"   @else href="javascript:changestatus(1);"  @endif >
                <div class="d-flex flex-column mx-auto">
                    <i data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Calendar"></span>
                    <p>Place Bids</p>
                </div>
            </a>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center @if($activeMenu=='My Bids') active @endif"
           @if($vendor->status==1 && $subscriptiontype->period_months <> '0' ) href="{{route('ppanel.mybids')}}"  @elseif($vendor->status==1 && $subscriptiontype->period_months == '0' ) href="javascript:changestatus(4);" @else href="javascript:changestatus(1);"  @endif >
            
                <div class="d-flex flex-column mx-auto">
                    <i data-feather="file"></i><span class="menu-title text-truncate"
                        data-i18n="Calendar"></span>
                    <p>My Bids</p>
                </div>
            </a>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center @if($activeMenu=='Support' || $activeMenu=='Manage Tickets') active @endif" href="{{route('ppanel.support')}}">
                <div class="d-flex flex-column mx-auto">
                    <i data-feather="help-circle"></i><span class="menu-title text-truncate"
                        data-i18n="Calendar"></span>
                    <p>Support</p>
                </div>
            </a>
        </li>
    </ul>
</div>


