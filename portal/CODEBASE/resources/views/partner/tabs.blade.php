<ul class="nav nav-pills tabs-pages tab-leftside">
    <li class="nav-item">
        <a class="nav-link @if($activeSubmenu=='partner') active @endif" href="{{route('partner')}}"> <span class="bs-stepper-box">
        <i class="fal fa-cog" class="font-medium-3"></i>
        </span>All Business Partners</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($activeSubmenu=='managepartner') active @endif" href="{{route('managepartner')}}"> <span class="bs-stepper-box">
        <i data-feather="package" class="font-medium-3"></i>
        </span>Manage Business Partners</a>
    </li>
    
</ul>