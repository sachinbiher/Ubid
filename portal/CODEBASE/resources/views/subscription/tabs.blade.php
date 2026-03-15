<ul class="nav nav-pills tabs-pages tab-leftside">
    <li class="nav-item">
        <a class="nav-link @if($activeSubmenu=='subscription') active @endif" href="{{url('subscription')}}"> <span class="bs-stepper-box">
        <i data-feather="package" class="font-medium-3"></i>
        </span>Manage Subscriptions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($activeSubmenu=='subscribers') active @endif" href="{{url('subscribers')}}"> <span class="bs-stepper-box">
        <i class="fal fa-cog" class="font-medium-3"></i>
        </span>Manage Subscribers</a>
    </li>
</ul>