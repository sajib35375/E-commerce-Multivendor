<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('AdminBackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('brand.view') }}"><i class="bx bx-right-arrow-alt"></i>All Brands</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('category.view') }}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                </li>

                <li> <a href="{{ route('subcategory.view') }}"><i class="bx bx-right-arrow-alt"></i>SubCategory</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Slider Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('slider.view') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>



            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('banner.view') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                </li>



            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>

                <li> <a href="{{ route('add.new.product') }}"><i class="bx bx-right-arrow-alt"></i>Add New Product</a>
                </li>

            </ul>
        </li>


        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Coupon Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                </li>


            </ul>
        </li>
        <li class="menu-label">UI Elements</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Vendor</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.active') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
                <li> <a href="{{ route('vendor.inactive') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Shipping</div>
            </a>
            <ul>
                <li> <a href="{{ route('division.view') }}"><i class="bx bx-right-arrow-alt"></i>Division</a>
                </li>
                <li> <a href="{{ route('district.view') }}"><i class="bx bx-right-arrow-alt"></i>District</a>
                </li>
                <li> <a href="{{ route('state.view') }}"><i class="bx bx-right-arrow-alt"></i>State</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Order</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
                </li>

                <li> <a href="{{ route('all.confirm.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirm Order</a>
                </li>

                <li> <a href="{{ route('all.process.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
                </li>

                <li> <a href="{{ route('all.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Return Order</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
                </li>
                <li> <a href="{{ route('all.approve.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Approve Request</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Manage Stock</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Stock</a>
                </li>

            </ul>
        </li>


        <li class="menu-label">Others</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">All Report</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.reports') }}"><i class="bx bx-right-arrow-alt"></i>All Report</a>
                </li>
                <li> <a href="{{ route('user.reports.show') }}"><i class="bx bx-right-arrow-alt"></i>User Reports</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Manage User</div>
            </a>
            <ul>
                <li> <a href="{{ route('active.user') }}"><i class="bx bx-right-arrow-alt"></i>All Active User</a>
                </li>
                <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Active Vendor</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Manage Blog</div>
            </a>
            <ul>
                <li> <a href="{{ route('blog.category') }}"><i class="bx bx-right-arrow-alt"></i>Blog Category</a>
                </li>

                <li> <a href="{{ route('add.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>Add Blog Post</a>
                </li>

                <li> <a href="{{ route('blog.post') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Post</a>
                </li>

            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Manage Review</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.review') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
                </li>



            </ul>
        </li>


        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Manage Setting</div>
            </a>
            <ul>
                <li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
                </li>

                <li> <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
                </li>

            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Manage Permission</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Permission</a>
                </li>
                <li> <a href="{{ route('view.roles') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>

                <li> <a href="{{ route('add.roles') }}"><i class="bx bx-right-arrow-alt"></i>Add New Role</a>
                </li>

                <li> <a href="{{ route('roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Add Roles in Permission</a>
                </li>

                <li> <a href="{{ route('role.permission.view') }}"><i class="bx bx-right-arrow-alt"></i>Roles in Permission Edit</a>
                </li>



            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
