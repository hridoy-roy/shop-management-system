<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Account</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('withdraw.create')}}" key="t-level-1-1">Cash Withdraw</a></li>
                        <li><a href="{{route('withdraw.index')}}" key="t-level-1-1">Cash Withdraw Report</a></li>
                        <li><a href="{{route('withdraw.hold.list')}}" key="t-level-1-1">Cash Withdraw Hold</a></li>
                        <li><a href="{{route('balance.sheet')}}" key="t-level-1-1">Balance Sheet</a></li>
                        <li><a href="{{route('profit.loss')}}" key="t-level-1-1">Profit & Loss Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Item Manage</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('categories.index')}}" key="t-level-1-1">Product Category</a></li>
                        <li><a href="{{route('products.index')}}" key="t-level-1-1">Product Info</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Purchase</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('purchases.create')}}" key="t-level-1-1">Purchase Order</a></li>
                        <li><a href="{{route('purchases.index')}}" key="t-level-1-1">Purchase Report</a></li>
                    </ul>
                </li>

                <li class="{{Request::routeIs('stock.*') ? 'mm-active': ''}}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Stock </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('stock.present.list')}}" key="t-level-1-1">Present Stock</a></li>
                        <li><a href="{{route('stock.create')}}" class="{{Request::is('stock') ? 'active': ''}}"
                               key="t-level-1-1">Transaction Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Opening </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('opening.index')}}" key="t-level-1-1">Item / Cash Opening</a></li>
                        <li><a href="{{route('customer.index')}}">Customer</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Sale </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('sales.create')}}" key="t-level-1-1">Sales order</a></li>
                        <li><a href="{{route('sale.hold.list')}}" key="t-level-1-1">Sales Hold</a></li>
                        <li><a href="{{route('sale.due.list')}}" key="t-level-1-1">Sales Due</a></li>
                        <li><a href="{{route('sales.index')}}" key="t-level-1-1">Sales Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Return</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('saleReturns.create')}}" key="t-level-1-1">Sales Return</a></li>
                        <li><a href="{{route('purchaseReturns.create')}}" key="t-level-1-1">Purchase Return</a></li>
                        <li><a href="{{route('saleReturns.index')}}" key="t-level-1-1">Sales Return Reports</a></li>
                        <li><a href="{{route('purchaseReturns.index')}}" key="t-level-1-1">Purchase Return Reports</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">User Manage</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('users.index')}}" key="t-level-1-1">User list</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
