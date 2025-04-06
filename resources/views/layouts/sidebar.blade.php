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

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">User Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="member">
                        <i class=" ri-user-line"></i> <span data-key="t-member">Member</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="training">
                        <i class="ri-briefcase-line	"></i> <span data-key="t-authentication">Pelatihan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="announcement">
                        <i class="ri-megaphone-line	"></i> <span data-key="t-authentication">Announcement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon">
                        <i class="  ri-file-list-3-line"></i> <span data-key="t-authentication">@lang('translation.recommendations')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon">
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

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Master Data</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="bi bi-person-circle"></i> <span data-key="t-authentication">User</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="auth-signin-basic" class="nav-link" data-key="t-basic">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a href="auth-signin-basic-2" class="nav-link" data-key="t-basic-2">Anggota</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon">
                        <i class="ri-calendar-line"></i> <span data-key="t-authentication">Jadwal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon">
                        <i class="ri-stethoscope-line"></i> <span data-key="t-authentication">Dokter</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon">
                        <i class="ri-hospital-line"></i> <span data-key="t-authentication">Education</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="pages-coming-soon">
                        <i class="ri-volume-up-line"></i> <span data-key="t-authentication">Announcement Type</span>
                    </a>
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