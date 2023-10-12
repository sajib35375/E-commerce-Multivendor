@php

$id = Auth::guard('web')->id();
$data = \App\Models\User::find($id);
$status = $data->status;


@endphp
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('AdminBackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Vendor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('vendor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


@if($status=='active')

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Product</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                <li> <a href="{{ route('vendor.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add New Product</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Orders</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.pending.order') }}"><i class="bx bx-right-arrow-alt"></i>All Order</a>
                </li>

                <li> <a href="{{ route('vendor.return.order') }}"><i class="bx bx-right-arrow-alt"></i>All Return Order</a>
                <li> <a href="{{ route('vendor.approve.return.order') }}"><i class="bx bx-right-arrow-alt"></i>All Approve Return Order</a>
                </li>

            </ul>
        </li>


            <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Reviews</div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.review') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
                </li>


            </ul>
        </li>


@else
    @endif





        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
