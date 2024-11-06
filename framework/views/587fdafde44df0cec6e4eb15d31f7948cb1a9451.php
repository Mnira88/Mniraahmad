
<div class="scrollbar side-menu-bg" style="">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->

        <li>
            <a href="<?php echo e(url('/dashboard')); ?>">
                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Emotions</li>




        <li>
            <a href="<?php echo e(route('manager.newposts')); ?>"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">Recent Posts</span></a>
        </li>

        <li>
            <a href="<?php echo e(route('manager.oldposts')); ?>"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">Seen Posts</span></a>
        </li>



        <!-- الملف الشخصي-->
        <li>
            <a href="<?php echo e(route('manager.profile',session('user')->id )); ?>"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">Profile</span></a>
        </li>





    </ul>
</div>
<?php /**PATH C:\Users\mnira\Downloads\emotion_final_v2\emotion\resources\views/layouts/main-sidebar/manager-sidebar.blade.php ENDPATH**/ ?>