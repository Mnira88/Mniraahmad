<!DOCTYPE html>
<html >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Emotion</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="\assets\images\ico02.png" />

    <!-- Font -->
    

    <!-- css -->
    

<!--- Style css -->
<link href="<?php echo e(URL::asset('assets/css/style.css')); ?>" rel="stylesheet">

<!--- Style css -->
<?php if(App::getLocale() == 'en'): ?>
    <link href="<?php echo e(URL::asset('assets/css/ltr.css')); ?>" rel="stylesheet">
<?php else: ?>
    <link href="<?php echo e(URL::asset('assets/css/rtl.css')); ?>" rel="stylesheet">
<?php endif; ?>
<?php $__env->startSection('css'); ?>


</head>

<body style="background-color:rgb(255, 255, 255)">

<div class="wrapper">


    <!--==صورة التنقل -->

    <div id="pre-loader">
        
        <img src="<?php echo e(URL::asset('assets/images/pre-loader/loader.svg')); ?>" alt="">
    </div>

    <!--=============================== -->

        

        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo ml-3" style="font-size: 15px" href="#"><img src="<?php echo e(URL::asset('assets/images/ico02.png')); ?>" alt=""> We Discover You</a>
                <a class="navbar-brand brand-logo-mini" href="#"><img src="<?php echo e(URL::asset('assets/images/ico02.png')); ?>"
                        alt=""></a>


            </div>
            <!-- Top bar left -->

            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">

             

                

                 
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>

                

            </ul>
        </nav>
        




    <!--=======فورم تسجيل الدخول-->

    <section class="col-12 height-100vh d-flex align-items-center page-section-ptb ">
        <div class="row  card col-12 mt-5">

            <div class="row col-12 justify-content-center no-gutters vertical-align ">


                   
                <div class="col-4 bg-white  rounded"
                  style="background-color:rgb(216, 216, 216);">
                    <div class="login-fancy pb-40 clearfix text-center">

                            <h3 style="font-family: 'Cairo', sans-serif;color:red;" class="mb-30">Login</h3>

                        <?php if(\Session::has('message')): ?>
                            <div class="alert alert-danger">
                             <li><?php echo \Session::get('message'); ?></li>

                            </div>
                        <?php endif; ?>
						
						<?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('login')); ?>">
                            
                            <?php echo csrf_field(); ?>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="type">Login Type</label>
                                <select  required   class="custom-select" name="type"
                                style="background-color:rgb(216, 216, 216);;border:1px solid #4dd8c1;border-radius:.25rem;">
                                <option value="1">Site Admin</option>
                                 <option value="2">Hospital Manager</option>
                                 <option value="3">Patient / Visitor</option>
                                </select>
                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="email">email</label>
                                <input  required type="email"  class="form-control" name="email"autofocus
                                style="background-color:rgb(216, 216, 216);;border:1px solid #4dd8c1;border-radius:.25rem;">
                            </div>

                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">Password  </label>
                                <input required id="password" type="password"
                                  style="background-color:rgb(216, 216, 216);;border:1px solid #4dd8c1;border-radius:.25rem;"
                                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                       required autocomplete="current-password">
                            </div>

                            <div class="row">

                                    <button class="button shadow rounded-10 ml-5"><span>Login</span><i class="fa fa-check"></i></button>

                                    <h4 class="text-black mt-2" style="font-family: 'Cairo', sans-serif" class="mb-30">
                                 <a class="text-primary ml-3" href="<?php echo e(route('password.forget')); ?>">Forget Password</a></h4>
                            </div>


                        </form>

             

           
                    </div>
                </div>

                

                 
                 <div class=" col-8">
                    <div class="login-fancy text-center">

                        <img alt="user-img" width="auto" height="auto" style="max-width: 100%" src="<?php echo e(URL::asset('assets/images/logo_01.png')); ?>">
                        <br><br><br>

                        <h3 class="text-black" style="font-family: 'Cairo', sans-serif" class="mb-30">Create New
                        <a class="text-primary" href="<?php echo e(route('manager.registerPage')); ?>">Hospital</a> or <a class="text-primary" href="<?php echo e(route('visitor.registerPage')); ?>">Patient</a> Account</h3>
                    </div>

                </div>

                  


            </div>
        </div>
    </section>

    <!--============نهاية فورم تسجيل الدخول-->


</div>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


 
<!-- jquery -->
<script src="<?php echo e(URL::asset('assets/js/jquery-3.3.1.min.js')); ?>"></script>
<!-- plugins-jquery -->
<script src="<?php echo e(URL::asset('assets/js/plugins-jquery.js')); ?>"></script>
<!-- plugin_path -->
<script>
    var plugin_path = 'js/';

</script>

<!-- chart -->

<!-- calendar -->

<!-- charts sparkline -->

<!-- charts morris -->

<!-- datepicker -->

<!-- sweetalert2 -->

<!-- toastr -->
<?php echo $__env->yieldContent('js'); ?>

<!-- validation -->

<!-- lobilist -->

<!-- custom -->
<script src="<?php echo e(URL::asset('assets/js/custom.js')); ?>"></script>

</body>

</html>
<?php /**PATH D:\Projects\WEB\work6\saleh\Emotion_khalid\emotion\resources\views/login/login.blade.php ENDPATH**/ ?>