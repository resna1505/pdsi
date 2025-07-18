
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


<style>
/* Search Modal Styles */
#searchModal .modal-dialog {
    margin-top: 10vh;
}

#searchModal .modal-content {
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

#searchModal .modal-header {
    border-bottom: none;
    padding-bottom: 0;
}

/* Search Input Styles */
#search-options {
    border-radius: 8px;
    padding-left: 45px;
    padding-right: 80px;
    font-size: 16px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

#search-options:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Search Icon */
.search-widget-icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
}

.search-widget-icon:first-of-type {
    left: 15px;
    color: #6c757d;
}

.search-widget-icon-close {
    right: 15px;
    color: #6c757d;
    text-decoration: none;
}

.search-widget-icon-close:hover {
    color: #007bff;
}

/* Search Dropdown */
#search-dropdown {
    position: static !important;
    transform: none !important;
    width: 100%;
    border: none;
    box-shadow: none;
    display: block !important;
    opacity: 1 !important;
}

#search-dropdown .dropdown-head {
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

/* Search Results */
.notify-item {
    padding: 12px 15px;
    border: none;
    border-radius: 6px;
    margin-bottom: 4px;
    transition: all 0.3s ease;
}

.notify-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.notify-item i {
    width: 20px;
    text-align: center;
}

.notification-title {
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
}

.notification-group-list {
    margin-bottom: 20px;
}

.notification-group-list:last-child {
    margin-bottom: 0;
}

/* Avatar Styles */
.avatar-xs {
    width: 32px;
    height: 32px;
    object-fit: cover;
}

/* Loading State */
.spinner-border {
    width: 2rem;
    height: 2rem;
}

/* No Results State */
.fs-24 {
    font-size: 24px;
}

/* Recent Search Tags */
.btn-soft-secondary {
    background-color: #e9ecef;
    border-color: #e9ecef;
    color: #6c757d;
    border-radius: 20px;
    padding: 6px 12px;
    font-size: 12px;
    margin-right: 8px;
    margin-bottom: 8px;
}

.btn-soft-secondary:hover {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

/* Search Result Categories */
.list-group-item {
    border: none;
    padding: 10px 15px;
    margin-bottom: 2px;
    border-radius: 6px;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

/* Responsive */
@media (max-width: 768px) {
    #searchModal .modal-dialog {
        margin: 5vh auto;
        width: 95%;
    }
    
    #search-options {
        font-size: 14px;
        padding-left: 40px;
        padding-right: 70px;
    }
    
    .search-widget-icon:first-of-type {
        left: 12px;
        font-size: 14px;
    }
    
    .search-widget-icon-close {
        right: 12px;
        font-size: 12px;
    }
}
</style>

<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="25">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="25">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <button type="button" class="btn btn-sm px-3 fs-15 text-reset header-item d-none d-md-block"
                    data-bs-toggle="modal" data-bs-target="#searchModal">
                    <span class="bi bi-search me-2"></span> Search for PDSI...
                </button>
            </div>

            <div class="d-flex align-items-center">

                <div class="d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="bi bi-search fs-16"></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='bi bi-grid fs-18'></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fw-semibold fs-15"> <?php echo app('translator')->get('translation.our-social-media'); ?> </h6>
                                </div>
                            </div>
                        </div>

                        <div class="p-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="https://www.instagram.com/dokterseluruhindonesia/" target="_blank">
                                        <img src="<?php echo e(URL::asset('build/images/brands/instagram.png')); ?>" alt="instagram">
                                        <span>Instagram</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="https://www.tiktok.com/@pp_pdsi?_t=ZS-8xgE7ku1anX&_r=1" target="_blank">
                                        <img src="<?php echo e(URL::asset('build/images/brands/tiktok.png')); ?>" alt="tiktok">
                                        <span>Tiktok</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="https://www.facebook.com/officialpdsi" target="_blank">
                                        <img src="<?php echo e(URL::asset('build/images/brands/facebook.png')); ?>" alt="facebook">
                                        <span>Facebook</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">                                
                                <div class="col">
                                    <a class="dropdown-icon-item" href="https://id.linkedin.com/company/perkumpulan-dokter-seluruh-indonesia" target="_blank">
                                        <img src="<?php echo e(URL::asset('build/images/brands/linkedin.png')); ?>" alt="linkedin">
                                        <span>Linkedin</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="https://x.com/PP_PDSI" target="_blank">
                                        <img src="<?php echo e(URL::asset('build/images/brands/twitter.png')); ?>" alt="twitter">
                                        <span>X</span>
                                    </a>
                                </div>
                                <div class="col">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bi bi-arrows-fullscreen fs-16'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle mode-layout"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-sun align-middle fs-20"></i>
                    </button>
                    <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                        <a href="#!" class="dropdown-item" data-mode="light"><i
                                class="bi bi-sun align-middle me-2"></i> Default (light mode)</a>
                        <a href="#!" class="dropdown-item" data-mode="dark"><i
                                class="bi bi-moon align-middle me-2"></i> Dark</a>
                        <a href="#!" class="dropdown-item" data-mode="auto"><i
                                class="bi bi-moon-stars align-middle me-2"></i> Auto (system default)</a>
                    </div>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bi bi-bell fs-18'></i>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><span
                                class="notification-badge">0</span><span class="visually-hidden">unread
                                messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head rounded-top">
                            <div class="p-3 border-bottom border-bottom-dashed">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0 fs-16 fw-semibold"> Notifications <span
                                                class="badge text-danger  bg-danger-subtle fs-13 notification-badge">
                                                0</span></h6>
                                        <p class="fs-14 text-muted mt-1 mb-0">You have <span
                                                class="fw-semibold notification-unread">0</span> unread messages</p>
                                    </div>
                                    <div class="col-auto dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                            class="link-secondary fs-14"><i class="bi bi-three-dots-vertical"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">All Clear</a></li>
                                            <li><a class="dropdown-item" href="#">Mark all as read</a></li>
                                            <li><a class="dropdown-item" href="#">Archive All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                src="<?php echo e(Auth::user()->anggota?->avatar
                                    ? asset('storage/images/users/' . Auth::user()->anggota->avatar)
                                    : asset('build/images/users/avatar-1.jpg')); ?>"
                                alt="User Avatar">
                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(Auth::user()->anggota?->nama); ?></span>
                                <span class="d-none d-xl-block ms-1 fs-13 text-reset user-name-sub-text"><?php echo e(Auth::user()->anggota?->profesi); ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Welcome <?php echo e(Auth::user()->anggota?->nama); ?> <?php echo e(Auth::user()->last_name); ?>!</h6>
                            <a class="dropdown-item" href="<?php echo e(url('/profile-dokter')); ?>"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span>
                            </a>
                            <a class="dropdown-item" href="<?php echo e(url('/faq-dokter')); ?>"><i
                                class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Help</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="<?php echo e(route('lockscreen.lock')); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item border-0 bg-transparent">
                                    <i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> 
                                    <span class="align-middle">Lock screen</span>
                                </button>
                            </form>
                            <a class="dropdown-item " href="<?php echo e(url('logout')); ?>"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" key="t-logout">logout</span>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded">
            <div class="modal-header p-3">
                <div class="position-relative w-100">
                    <input type="text" class="form-control form-control-lg border-2"
                        placeholder="Search for PDSI..." autocomplete="off" id="search-options" value="">
                    <span class="bi bi-search search-widget-icon fs-17"></span>
                    <a href="javascript:void(0);"
                        class="search-widget-icon fs-14 link-secondary text-decoration-underline search-widget-icon-close d-none"
                        id="search-close-options">Clear</a>
                </div>
            </div>
            
            
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 overflow-hidden show" id="search-dropdown">
                <div class="dropdown-head rounded-top">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fs-14 text-muted fw-semibold"> RECENT SEARCHES </h6>
                            </div>
                        </div>
                    </div>

                    
                </div>

                <div data-simplebar style="max-height: 400px;" class="pe-2 ps-3 my-3">
                    <div class="list-group list-group-flush">
                        <div class="notification-group-list">
                            
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Search script loaded!');
    
    const searchInput = document.getElementById('search-options');
    const searchDropdown = document.getElementById('search-dropdown');
    const searchModal = document.getElementById('searchModal');
    const clearBtn = document.getElementById('search-close-options');
    
    console.log('Elements found:', {
        searchInput: !!searchInput,
        searchDropdown: !!searchDropdown,
        searchModal: !!searchModal,
        clearBtn: !!clearBtn
    });
    
    let searchTimeout;
    
    // Event listener untuk input search
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            console.log('Input detected, query:', query);
            
            // Clear previous timeout
            clearTimeout(searchTimeout);
            
            // Show/hide clear button
            if (query.length > 0) {
                clearBtn.classList.remove('d-none');
            } else {
                clearBtn.classList.add('d-none');
            }
            
            // Debounce search (delay 300ms)
            searchTimeout = setTimeout(() => {
                console.log('Timeout triggered for query:', query);
                if (query.length >= 2) {
                    performSearch(query);
                } else if (query.length === 0) {
                    showRecentSearches();
                }
            }, 300);
        });
    }
    
    // Clear search
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            console.log('Clear button clicked');
            searchInput.value = '';
            clearBtn.classList.add('d-none');
            showRecentSearches();
        });
    }
    
    // Show recent searches when modal opens
    if (searchModal) {
        searchModal.addEventListener('shown.bs.modal', function() {
            console.log('Modal opened');
            searchInput.focus();
            if (searchInput.value.trim() === '') {
                showRecentSearches();
            }
        });
    }
    
    function performSearch(query) {
        console.log('=== PERFORM SEARCH START ===');
        console.log('Query:', query);
        
        // Show loading state
        showLoadingState();
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const tokenValue = csrfToken ? csrfToken.getAttribute('content') : null;
        
        console.log('CSRF Token found:', !!csrfToken);
        console.log('CSRF Token value:', tokenValue);
        
        // Prepare request
        const requestData = { query: query };
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': tokenValue || ''
            },
            body: JSON.stringify(requestData)
        };
        
        console.log('Request URL:', '/search-global');
        console.log('Request data:', requestData);
        console.log('Request headers:', requestOptions.headers);
        
        fetch('/search-global', requestOptions)
        .then(response => {
            console.log('=== RESPONSE RECEIVED ===');
            console.log('Status:', response.status);
            console.log('Status Text:', response.statusText);
            console.log('Headers:', Object.fromEntries(response.headers.entries()));
            
            // Clone response untuk debugging
            return response.clone().text().then(text => {
                console.log('Raw response text:', text);
                
                // Try to parse as JSON
                try {
                    const data = JSON.parse(text);
                    console.log('Parsed JSON:', data);
                    displaySearchResults(data);
                } catch (e) {
                    console.error('JSON parse error:', e);
                    console.log('Response is not JSON, probably HTML error page');
                    showErrorState();
                }
            });
        })
        .catch(error => {
            console.error('=== FETCH ERROR ===');
            console.error('Error type:', error.name);
            console.error('Error message:', error.message);
            console.error('Full error:', error);
            showErrorState();
        });
    }
    
    function showLoadingState() {
        console.log('Showing loading state');
        const resultsContainer = searchDropdown.querySelector('.pe-2.ps-3.my-3');
        if (resultsContainer) {
            resultsContainer.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-2">Searching...</p>
                </div>
            `;
        }
    }
    
    function showErrorState() {
        console.log('Showing error state');
        const resultsContainer = searchDropdown.querySelector('.pe-2.ps-3.my-3');
        if (resultsContainer) {
            resultsContainer.innerHTML = `
                <div class="text-center py-4">
                    <i class="bi bi-exclamation-triangle text-warning fs-24"></i>
                    <p class="text-muted mt-2">Something went wrong. Please try again.</p>
                    <small class="text-muted">Check console for details</small>
                </div>
            `;
        }
    }
    
    function displaySearchResults(data) {
        console.log('Displaying search results:', data);
        const resultsContainer = searchDropdown.querySelector('.pe-2.ps-3.my-3');
        let html = '';
        
        // Check if we have any results
        const hasResults = (data.menus && data.menus.length > 0) ||
                          (data.users && data.users.length > 0) ||
                          (data.agendas && data.agendas.length > 0) ||
                          (data.news && data.news.length > 0) ||
                          (data.workshops && data.workshops.length > 0);
        
        if (!hasResults) {
            html = `
                <div class="text-center py-4">
                    <i class="bi bi-search text-muted fs-24"></i>
                    <p class="text-muted mt-2">No results found</p>
                </div>
            `;
        } else {
            html = '<div class="list-group list-group-flush">';
            
            // Menus Section
            if (data.menus && data.menus.length > 0) {
                html += `
                    <div class="notification-group-list">
                        <h5 class="text-overflow text-muted fs-13 mb-2 mt-3 text-uppercase notification-title">
                            Menus
                        </h5>
                `;
                data.menus.forEach(menu => {
                    html += `
                        <a href="${menu.url}" class="list-group-item dropdown-item notify-item">
                            <i class="${menu.icon} me-2"></i> 
                            <span>${menu.title}</span>
                        </a>
                    `;
                });
                html += '</div>';
            }
            
            // Users Section
            if (data.users && data.users.length > 0) {
                html += `
                    <div class="notification-group-list">
                        <h5 class="text-overflow text-muted fs-13 mb-2 mt-3 text-uppercase notification-title">
                            Users
                        </h5>
                `;
                data.users.forEach(user => {
                    html += `
                        <a href="${user.url}" class="list-group-item dropdown-item notify-item">
                            <div class="d-flex align-items-center">
                                <img src="/storage/images/users/${user.avatar}" 
                                     class="avatar-xs rounded-circle flex-shrink-0 me-2" 
                                     alt="${user.name}"
                                     onerror="this.src='/build/images/users/avatar-1.jpg'">
                                <div>
                                    <h6 class="mb-0">${user.name}</h6>
                                    <span class="fs-13 text-muted">${user.role}</span>
                                </div>
                            </div>
                        </a>
                    `;
                });
                html += '</div>';
            }
            
            html += '</div>';
        }
        
        if (resultsContainer) {
            resultsContainer.innerHTML = html;
        }
    }
    
    function showRecentSearches() {
        console.log('Showing recent searches');
        const resultsContainer = searchDropdown.querySelector('.pe-2.ps-3.my-3');
        if (resultsContainer) {
            resultsContainer.innerHTML = `
                <div class="list-group list-group-flush">
                    <div class="notification-group-list">
                        <h5 class="text-overflow text-muted fs-13 mb-2 mt-3 text-uppercase notification-title">Apps Pages</h5>
                        <a href="javascript:void(0);" class="list-group-item dropdown-item notify-item">
                            <i class="bi bi-speedometer2 me-2"></i> <span>Analytics Dashboard</span>
                        </a>
                        <a href="javascript:void(0);" class="list-group-item dropdown-item notify-item">
                            <i class="bi bi-filetype-psd me-2"></i> <span>PDSI.psd</span>
                        </a>
                        <a href="javascript:void(0);" class="list-group-item dropdown-item notify-item">
                            <i class="bi bi-ticket-detailed me-2"></i> <span>Support Tickets</span>
                        </a>
                        <a href="javascript:void(0);" class="list-group-item dropdown-item notify-item">
                            <i class="bi bi-file-earmark-zip me-2"></i> <span>PDSI.zip</span>
                        </a>
                    </div>                
                </div>
            `;
        }
    }
    
    console.log('Search script initialization complete!');
});
</script>

<script>
function lockScreen() {
    if (confirm('Apakah Anda yakin ingin mengunci layar?')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo e(route("lockscreen.lock")); ?>';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '<?php echo e(csrf_token()); ?>';
        
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}
</script><?php /**PATH D:\Project\pdsi\resources\views/layouts/topbar.blade.php ENDPATH**/ ?>