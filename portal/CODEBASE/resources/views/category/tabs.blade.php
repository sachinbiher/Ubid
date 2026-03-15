<ul class="nav nav-pills tabs-pages tab-leftside">
    <li class="nav-item">
        <a class="nav-link @if($activeSubmenu=='categories') active @endif" href="{{route('category')}}"> <span class="bs-stepper-box">
        <i data-feather="package" class="font-medium-3"></i>
        </span>Manage Categories</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($activeSubmenu=='subcategories') active @endif" href="{{route('childcategory')}}"> <span class="bs-stepper-box">
        <i  data-feather="package" class="font-medium-3"></i>
        </span>Manage Sub Categories</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($activeSubmenu=='ticketcategory') active @endif" href="{{route('ticketcategory')}}"> <span class="bs-stepper-box">
        <i  data-feather="package" class="font-medium-3"></i>
        </span>Manage Ticketing Categories</a>
    </li>
</ul>