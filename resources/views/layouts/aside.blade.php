<div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto"  id="kt_aside">
    <div class="brand flex-column-auto " id="kt_brand">
        <a href="{{ url('') }}" class="brand-logo">
            <h4 class="text-white">Exchange Rate</h4>
        </a>
</div>

<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <ul class="menu-nav ">
            <li class="menu-item" aria-haspopup="true" >
                <a href="{{ url('') }}" class="menu-link ">
                    <span class="menu-icon">
                        <i class="flaticon2-dashboard"></i>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            @if (Auth::user()->role->name == 'Admin')
                <li class="menu-item" aria-haspopup="true" >
                    <a href="{{ url('users') }}" class="menu-link ">
                        <span class="menu-icon">
                            <i class="flaticon2-user"></i>
                        </span>
                        <span class="menu-text">Users</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
