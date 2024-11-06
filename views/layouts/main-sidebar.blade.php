<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">

            @if (auth('admin')->check())
                @include('layouts.main-sidebar.admin-sidebar')
            @elseif (auth('manager')->check())
                @include('layouts.main-sidebar.manager-sidebar')
            @elseif (auth('visitor')->check())
                @include('layouts.main-sidebar.visitor-sidebar')
            @endif







        </div>

        <!-- Left Sidebar End-->

        <!--=================================
