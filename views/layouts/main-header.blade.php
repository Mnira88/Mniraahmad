<!--=================================
header start-->

<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">

        <a class="navbar-brand brand-logo" style="font-size: 15px" href="{{ url('/dashboard') }}"><img src="{{ URL::asset('assets/images/ico02.png') }}" alt="">
            Welcome -
            {{-- @if(auth('web')->check()) --}}
              <label for="welcome" class="" >Emotions
                 {{-- {{session('user')->name}} --}}

            {{-- @endif --}}
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}"><img src="{{ URL::asset('assets/images/ico02.png') }}"
                alt=""></a>


    </div>
    <!-- Top bar left -->


    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">

{{-- =========Language Button================ --}}


        {{-- ========End Language Butoon=================== --}}


         {{-- ========Full Screen  Butoon=================== --}}
        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>

       {{-- ========قائمة أوامر المستخدم المسجل=================== --}}
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ URL::asset('assets/images/user_icon.png') }}" alt="avatar">


            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{session('user')->name}}</h5>
                            {{-- <h5 class="mt-0 mb-0">{{Auth::user()->id}}</h5> --}}

                        </div>
                    </div>
                </div>
                <div></div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i><span>{{ session('user')->email }}</span></a>
                <div class="dropdown-divider"></div>
                {{-- <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a> --}}
      {{-- ====================أمر تسجيل الخروج --}}

      @if(auth('admin')->check())
        <form method="GET" action="{{ route('logout','admin') }}">
            @elseif(auth('manager')->check())
             <form method="GET" action="{{ route('logout','manager') }}">
                @elseif(auth('visitor')->check())
                   <form method="GET" action="{{ route('logout','visitor') }}">
      @endif

        @csrf
           <a class="dropdown-item" href="#" onclick="event.preventDefault();
                   this.closest('form').submit();"><i class="bx bx-log-out">
               </i>Logout
          </a>
       </form>

      {{-- ============================نهاية تسجيل الخروج --}}


            </div>
        </li>

         {{-- ========نهاية قائمة أوامر المستخدم المسجل=================== --}}
    </ul>
</nav>

<!--=================================
header End-->
