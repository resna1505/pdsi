<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="26">
            </span>
        </a>
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="26">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
            
                <li class="menu-title"><span data-key="t-menu">@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a href="index" class="nav-link menu-link"> <i class=" ri-pie-chart-line"></i> <span data-key="t-dashboard">@lang('translation.dashboards')</span> </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">@lang('translation.pages')</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon" role="button" aria-expanded="false" aria-controls="pages-coming-soon">
                        <i class="  ri-file-list-3-line"></i> <span data-key="t-authentication">@lang('translation.recommendations')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon" role="button" aria-expanded="false" aria-controls="pages-coming-soon">
                        <i class="   ri-pin-distance-line"></i> <span data-key="t-authentication">@lang('translation.relocations')</span>
                    </a>
                </li>
                
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-apps">@lang('translation.apps')</span></li>
                
                <li class="nav-item">
                    <a href="apps-calendar" class="nav-link menu-link"> <i class="bi bi-calendar3"></i> <span data-key="t-calendar">@lang('translation.calendar')</span> </a>
                </li>
                <li class="nav-item">
                    <a href="apps-leaderboards" class="nav-link menu-link"> <i class="bi bi-gem"></i> <span data-key="t-leaderboard">@lang('translation.leaderboard')</span> </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>