
    <!-- Navbar Vertical -->
    <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset">
                <!-- Logo -->
                <a class="navbar-brand" href="{{url('/home')}}" aria-label="Front">
                    <img
                        class="navbar-brand-logo"
                        src="{{asset('assets/svg/logos/logo.svg')}}"
                        alt="Logo"
                        data-hs-theme-appearance="default"
                    >
                    <img
                        class="navbar-brand-logo"
                        src="{{asset('assets/svg/logos-light/logo.svg')}}"
                        alt="Logo"
                        data-hs-theme-appearance="dark"
                    >
                </a>
                <!-- End Logo -->
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                    <i
                        class="bi-arrow-bar-left navbar-toggler-short-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip"
                        data-bs-placement="right"
                        title="Collapse"
                    ></i>
                    <i
                        class="bi-arrow-bar-right navbar-toggler-full-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip"
                        data-bs-placement="right"
                        title="Expand"
                    ></i>
                </button>
                <!-- End Navbar Vertical Toggle -->
                <!-- Content -->
                <div class="navbar-vertical-content">
                    <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                        <!-- Collapse -->
                        <div class="nav-item">
                            <a
                                class="nav-link active"
                                href="{{url('/home')}}"
                                role="button"
                            >
                                <i class="bi-house-door nav-icon"></i>
                                <span class="nav-link-title">Dashboards</span>
                            </a>
                        </div>
                        <!-- End Collapse -->
                        <span class="dropdown-header mt-4">Management</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>
                        <!-- Collapse -->
                        <div class="navbar-nav nav-compact"></div>
                        <div id="navbarVerticalMenuPagesMenu">
                            <!-- Collapse -->
                            <div class="nav-item">
                                <a
                                    class="nav-link dropdown-toggle "
                                    href="#navbarVerticalMenuPagesUsersMenu"
                                    role="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#navbarVerticalMenuPagesUsersMenu"
                                    aria-expanded="false"
                                    aria-controls="navbarVerticalMenuPagesUsersMenu"
                                >
                                    <i class="bi-people nav-icon"></i>
                                    <span class="nav-link-title">Admins</span>
                                </a>
                                <div id="navbarVerticalMenuPagesUsersMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <a class="nav-link " href="{{route('showAdmins')}}">Show Admins</a>
                                    <a class="nav-link " href="{{route('createAdmin')}}">
                                        Add Admin
                                        <span class="badge bg-info rounded-pill ms-1">Hot</span>
                                    </a>
                                    <a class="nav-link " href="{{route('roles.index')}}">Permissions</a>
                                </div>
                            </div>
                            <!-- End Collapse -->

                        </div>
                        <!-- End Collapse -->
                        <span class="dropdown-header mt-4">Pages</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>
                        <div class="nav-item">
                            <a class="nav-link " href="{{route('showCategory')}}" data-placement="left">
                                <i class="bi-kanban nav-icon"></i>
                                <span class="nav-link-title">Categories</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link " href="{{route('showCity')}}" data-placement="left">
                                <i class="bi-kanban nav-icon"></i>
                                <span class="nav-link-title">Cities</span>
                            </a>
                        </div>

                    </div>
                </div>
                <!-- End Content -->



                <!-- Footer -->
                <div class="navbar-vertical-footer">
                    <ul class="navbar-vertical-footer-list">
                        <li class="navbar-vertical-footer-list-item">
                            <!-- Style Switcher -->
                            <div class="dropdown dropup">
                                <button
                                    type="button"
                                    class="btn btn-ghost-secondary btn-icon rounded-circle"
                                    id="selectThemeDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    data-bs-dropdown-animation
                                ></button>
                                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        data-icon="bi-moon-stars"
                                        data-value="auto"
                                    >
                                        <i class="bi-moon-stars me-2"></i>
                                        <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        data-icon="bi-brightness-high"
                                        data-value="default"
                                    >
                                        <i class="bi-brightness-high me-2"></i>
                                        <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                                    </a>
                                    <a
                                        class="dropdown-item active"
                                        href="#"
                                        data-icon="bi-moon"
                                        data-value="dark"
                                    >
                                        <i class="bi-moon me-2"></i>
                                        <span class="text-truncate" title="Dark">Dark</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End Style Switcher -->
                        </li>
                        <li class="navbar-vertical-footer-list-item">
                            <!-- Other Links -->
                            <div class="dropdown dropup">
                                <button
                                    type="button"
                                    class="btn btn-ghost-secondary btn-icon rounded-circle"
                                    id="otherLinksDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    data-bs-dropdown-animation
                                >
                                    <i class="bi-info-circle"></i>
                                </button>
                                <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="otherLinksDropdown">
                                    <span class="dropdown-header">Help</span>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-journals dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Resources &amp; tutorials">Resources &amp; tutorials</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-command dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Keyboard shortcuts">Keyboard shortcuts</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-alt dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Connect other apps">Connect other apps</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-gift dropdown-item-icon"></i>
                                        <span class="text-truncate" title="What's new?">What's new?</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">Contacts</span>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-chat-left-dots dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Contact support">Contact support</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End Other Links -->
                        </li>
                        <li class="navbar-vertical-footer-list-item">
                            <!-- Language -->
                            <div class="dropdown dropup">
                                <button
                                    type="button"
                                    class="btn btn-ghost-secondary btn-icon rounded-circle"
                                    id="selectLanguageDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    data-bs-dropdown-animation
                                >
                                    <img class="avatar avatar-xss avatar-circle" src="../assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="United States Flag">
                                </button>
                                <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectLanguageDropdown">
                                    <span class="dropdown-header">Select language</span>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="../assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Flag">
                                        <span class="text-truncate" title="English">English (US)</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="../assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Flag">
                                        <span class="text-truncate" title="English">English (UK)</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="../assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Flag">
                                        <span class="text-truncate" title="Deutsch">Deutsch</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="../assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Flag">
                                        <span class="text-truncate" title="Dansk">Dansk</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="../assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Flag">
                                        <span class="text-truncate" title="Italiano">Italiano</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="../assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Flag">
                                        <span class="text-truncate" title="中文 (繁體)">中文 (繁體)</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End Language -->
                        </li>
                    </ul>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </aside>
    <!-- End Navbar Vertical -->




