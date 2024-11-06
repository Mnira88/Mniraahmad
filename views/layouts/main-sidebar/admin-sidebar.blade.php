{{-- <div class="scrollbar side-menu-bg" style="overflow: scroll"> --}}
<div class="scrollbar side-menu-bg" style="">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->

        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Emotions</li>

        <!-- Accounts Management-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#account-management-menu">
                <div class="pull-left"> <i class="fas fa-user-tie  highlight-icon" aria-hidden="true"></i><span
                        class="right-nav-text">Accounts Management</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="account-management-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('adminusers.index') }}"> <i class="fas fa-list  highlight-icon" aria-hidden="true"></i>Admin Accounts</a></li>
                <li><a href="{{ route('appusers.index') }}"> <i class="fas fa-list  highlight-icon" aria-hidden="true"></i>Users Accounts</a></li>

            </ul>

        </li> --}}

        <li><a href="{{ route('admins.index') }}"> <i class="fas fa-user-tie  highlight-icon" aria-hidden="true"></i>Admins</a></li>
        <li><a href="{{ route('managers.index') }}"> <i class="fas fa-user-tie  highlight-icon" aria-hidden="true"></i>Managers</a></li>
        <li><a href="{{ route('visitors.index') }}"> <i class="fas fa-user-tie  highlight-icon" aria-hidden="true"></i>Visitors</a></li>


        <li>
            <a href="{{route('posts.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text"> Posts</span></a>
        </li>






        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('admin.profile',session('user')->id )}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">Profile</span></a>
        </li>





    </ul>
</div>
