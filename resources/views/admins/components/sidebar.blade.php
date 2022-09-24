<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">SIMito V2</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="javascript:ajaxLoad('{{route('admin.dashboard')}}')" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Inventory</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('stock_master.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Stock Master</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('adj.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Adjustment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('customer.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('vendor.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Vendor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('tax.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Tax</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Tools</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        @can('admin.view', Auth::user())
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('admin.user.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i><p>Admin</p>
                            </a>
                        </li>
                        @endcan
                        @can('role.view', Auth::user())
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('role.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-user-lock"></i><p>Role</p>
                            </a>
                        </li>
                        @endcan
                        @can('permission.view', Auth::user())
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('permission.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i><p>Permission</p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('branch.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i><p>Branch</p>
                            </a>
                        </li>
                    </ul>
                </li>                
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Website</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="javascript:ajaxLoad('{{route('admin.website.post.index')}}')" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Post</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Tags</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i><p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>