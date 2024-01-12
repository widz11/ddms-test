<aside class="left-sidebar" data-sidebarbg="skin6" style="background: #3B3486;">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="#" aria-expanded="false"><span class="circle">H</span><span
                        class="hide-menu">Invoice System</span></a></li>
                <li class="sidebar-item @if(Request::path() == '/' || Request::path() == 'invoice') selected @endif"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="/" aria-expanded="false"><i class="mdi mdi-book"></i><span
                            class="hide-menu">Invoice</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="/product" aria-expanded="false"><i class="mdi mdi-cube"></i><span
                        class="hide-menu">Product</span></a></li>
                {{-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="pages-profile.html" aria-expanded="false"><i
                            class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="table-basic.html" aria-expanded="false"><i class="mdi mdi-border-all"></i><span
                            class="hide-menu">Table</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="icon-material.html" aria-expanded="false"><i class="mdi mdi-face"></i><span
                            class="hide-menu">Icon</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="starter-kit.html" aria-expanded="false"><i class="mdi mdi-file"></i><span
                            class="hide-menu">Blank</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="error-404.html" aria-expanded="false"><i class="mdi mdi-alert-outline"></i><span
                            class="hide-menu">404</span></a></li>
                <li class="text-center p-40 upgrade-btn">
                    <a href="https://www.wrappixel.com/templates/flexy-bootstrap-admin-template/"
                        class="btn d-block w-100 btn-danger text-white" target="_blank">Upgrade to Pro</a>
                </li> --}}
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>