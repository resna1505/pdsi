<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="26">
            </span>
        </a>
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="26">
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
            
                <li class="menu-title"><span data-key="t-menu"><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a href="<?php echo e(url('/index')); ?>" class="nav-link menu-link"> <i class=" ri-pie-chart-line"></i> <span data-key="t-dashboard"><?php echo app('translator')->get('translation.dashboards'); ?></span> </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages"><?php echo app('translator')->get('translation.user-menu'); ?></span></li>

                <?php if(Auth::user()->level == 'Admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/member')); ?>">
                            <i class=" ri-user-line"></i> <span data-key="t-member"><?php echo app('translator')->get('translation.member'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/verifikasi-iuran')); ?>">
                            <i class=" ri-donut-chart-line"></i> <span data-key="t-verifikasi-iuran">Verifikasi Iuran</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Auth::user()->level == 'Dokter'): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/pembayaran-iuran')); ?>">
                            <i class=" ri-funds-line	"></i> <span data-key="t-pembayaran-iuran">Iuran Anggota</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/training')); ?>">
                            <i class="ri-briefcase-line	"></i> <span data-key="t-training"><?php echo app('translator')->get('translation.training'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('announcement.index')); ?>">
                            <i class="ri-megaphone-line	"></i> <span data-key="t-announcement"><?php echo app('translator')->get('translation.announcement'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                            <i class=" ri-pin-distance-line"></i> <span data-key="t-authentication">Tautan</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAuth">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/layanan/transformasi-kesehatan-indonesia" class="nav-link" data-key="t-basic" target="_blank">Transformasi Kesehatan Indonesia</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/layanan/gerakan-masyarakat-hidup-sehat" class="nav-link" data-key="t-basic-2" target="_blank">Gerakan Masyarakat Hidup Sehat</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/layanan/tenaga-kesehatan" class="nav-link" data-key="t-basic-2" target="_blank">Tenaga Kesehatan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/layanan/fasilitas-kesehatan" class="nav-link" data-key="t-basic-2" target="_blank">Fasilitas Kesehatan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://satusehat.kemkes.go.id/platform" class="nav-link" data-key="t-basic-2" target="_blank">Platform Satu Sehat</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/layanan/penanggulangan-penyakit" class="nav-link" data-key="t-basic-2" target="_blank">Penanggulangan Penyakit</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/layanan/farmasi-dan-alat-kesehatan" class="nav-link" data-key="t-basic-2" target="_blank">Farmasi Dan Alat Kesehatan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/layanan/kebijakan-kesehatan" class="nav-link" data-key="t-basic-2" target="_blank">Kebijakan Kesehatan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://kemkes.go.id/id/dashboard-krisis-kesehatan" class="nav-link" data-key="t-basic-2" target="_blank">Pantauan Kejadian Krisis Kesehatan</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-apps"><?php echo app('translator')->get('translation.apps'); ?></span></li>
                
                <li class="nav-item">
                    <a href="<?php echo e(url('/apps-calendar')); ?>" class="nav-link menu-link"> <i class="bi bi-calendar3"></i> <span data-key="t-calendar"><?php echo app('translator')->get('translation.calendar'); ?></span> </a>
                </li>
                <?php if(Auth::user()->level == 'Admin'): ?>    
                    <li class="nav-item">
                        <a href="<?php echo e(url('/apps-leaderboards')); ?>" class="nav-link menu-link"> <i class="bi bi-gem"></i> <span data-key="t-leaderboard"><?php echo app('translator')->get('translation.leaderboard'); ?></span> </a>
                    </li>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Master Data</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/user')); ?>">
                            <i class="bi bi-person-circle"></i> <span data-key="t-user"><?php echo app('translator')->get('translation.user'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/workshops')); ?>">
                            <i class="ri-calendar-line"></i> <span data-key="t-workshops"><?php echo app('translator')->get('translation.workshops'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/masteriuran')); ?>">
                            <i class="ri-money-dollar-circle-line"></i> <span data-key="t-masteriuran">Iuran</span>
                        </a>
                    </li>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Profile</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/slider')); ?>">
                            <i class="ri-slideshow-line"></i> <span data-key="t-slider">Banner</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/articles')); ?>">
                            <i class="ri-volume-up-line"></i> <span data-key="t-news-management"><?php echo app('translator')->get('translation.news'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/agenda')); ?>">
                            <i class=" ri-image-add-line"></i> <span data-key="t-agenda">Agenda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/mitra')); ?>">
                            <i class="ri-building-2-line"></i> <span data-key="t-mitra">Mitra</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/about')); ?>">
                            <i class=" ri-list-unordered"></i> <span data-key="t-about">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/visimisi')); ?>">
                            <i class=" ri-invision-line"></i> <span data-key="t-visimisi">Visi Misi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/programkerja')); ?>">
                            <i class="ri-briefcase-line"></i> <span data-key="t-programkerja">Program Kerja</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(url('/faq')); ?>">
                            <i class=" ri-questionnaire-line"></i> <span data-key="t-faq">FAQ</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Auth::user()->level == 'Dokter'): ?>                
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-apps">Faq</span></li>
                    
                    <li class="nav-item">
                        <a href="<?php echo e(url('/faq-dokter')); ?>" class="nav-link menu-link"> <i class=" ri-question-line"></i> <span data-key="t-faq-dokter">Faq</span> </a>
                    </li>
                <?php endif; ?>                
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div><?php /**PATH D:\Project\pdsi\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>