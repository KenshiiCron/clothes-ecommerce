
    <div class="col-lg-3">
        <div class="wrap-sidebar-account">
            <ul class="my-account-nav">
                <li><a href="{{route('account.details')}}" class="my-account-nav-item {{ request()->routeIs('account.details') ? 'active' : '' }}">Account Details</a></li>

                <li><a href="{{route('account.orders')}}" class="my-account-nav-item {{ request()->routeIs('account.orders*') ? 'active' : '' }}">{{__('labels.fields.orders')}}</a></li>
                <li><a href="{{route('account.wishlist')}}" class="my-account-nav-item {{ request()->routeIs('account.wishlist') ? 'active' : '' }}">{{__('labels.fields.wishlist')}}</a></li>
                <li>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                    <button type="submit" class="my-account-nav-item text-white bg-color-black">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

