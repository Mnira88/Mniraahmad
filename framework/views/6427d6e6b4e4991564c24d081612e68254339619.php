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


                   
                <div class="col-6 bg-white  rounded"
                  style="background-color:rgb(216, 216, 216);">
                    <div class="login-fancy pb-40 clearfix text-center">

                            <h3 style="font-family: 'Cairo', sans-serif;color:red;" class="mb-30">Register Patient Account</h3>

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

                        <form method="POST" action="<?php echo e(route('register.patient')); ?>">
                            
                            <?php echo csrf_field(); ?>

                            <fieldset class="row text-left" >
                                <input type="hidden" value="3" name="role_id">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                      <label for="name">Name</label>
                                      <input required type="text"  name="name" class="form-control" id="name" autofocus>
                                    </div>
                                </div>

                                  <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                      <label for="phone">Phone</label>
                                      <input required  type="number" pattern="[0-9]*" class="form-control" name="phone" id="phone"
                                        placeholder="Ex.05xxxxxxxx">
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                      <label for="email"> Email </label>
                                      <input required class="form-control" type="email" name="email" placeholder="your email"
                                        id="email">
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                      <label for="password"> Password </label>
                                      <input required class="form-control" type="password" name="password" id="password">
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                      <label for="c_password"> Confirm Password </label>
                                      <input required class="form-control" type="password" name="password_confirmation" id="c_password">
                                    </div>
                                  </div>



                            </fieldset>
                             <center>
                                <button class="button shadow rounded-10"><span>Sign Up</span><i class="fa fa-check"></i></button>
                             </center>

                        </form>

             



           
                    </div>
                </div>

                

                 
                 <div class=" col-6">
                    <div class="login-fancy text-center">

                        <img alt="user-img" width="auto" height="auto" style="max-width: 100%" src="<?php echo e(URL::asset('assets/images/logo_01.png')); ?>">
                        <br><br><br>

                        <h3 class="text-black" style="font-family: 'Cairo', sans-serif" class="mb-30">You Have An Account Please
                            <a class="text-primary" href="<?php echo e(route('login.show')); ?>">LOGIN</a></h3>
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
<?php /**PATH D:\Projects\WEB\work6\saleh\Emotion_khalid\emotion\resources\views/login/visitor_register.blade.php ENDPATH**/ ?>