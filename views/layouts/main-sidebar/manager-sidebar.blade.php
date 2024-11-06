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




        <li>
            <a href="{{route('manager.newposts')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">Recent Posts</span></a>
        </li>

        <li>
            <a href="{{route('manager.oldposts')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">Seen Posts</span></a>
        </li>



        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('manager.profile',session('user')->id )}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">Profile</span></a>
        </li>





    </ul>
</div>
