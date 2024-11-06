<?php $__env->startSection('css'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
<!-- breadcrumb -->
<?php $__env->startSection('PageTitle'); ?>
Profile
<?php $__env->stopSection(); ?>
<!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- row -->
<div class="row">


<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
     <div class="card-body">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
           <div class="container">

             <form action="<?php echo e(route('managers.update',session('user')->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo e(method_field('patch')); ?>

                           <?php echo csrf_field(); ?>

                            
                                <div class="card-body">

                                <section >
                                    <div class="row">
                                        
                                        <div class="col-lg-12">
                                            
                                                <div class="card-body">
                                                    <fieldset class="row" >
                                                        

                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="name">Name</label>
                                                              <input required type="text"  name="name" class="form-control" id="name" value="<?php echo e($manager->name); ?>"  autofocus>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="Hospital">Hospital</label>
                                                              <input required type="text"  name="hospital" class="form-control" id="hospital" value="<?php echo e($manager->hospital); ?>">
                                                            </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="phone">Phone</label>
                                                              <input required  type="number" pattern="[0-9]*" class="form-control" name="phone" id="phone" value="<?php echo e($manager->phone); ?>"
                                                                placeholder="Ex.05xxxxxxxx">
                                                            </div>
                                                          </div>
                                                          <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="email"> Email </label>
                                                              <input required  class="form-control" type="email" name="email" value="<?php echo e($manager->email); ?>"  placeholder="Ex. pat@example.com"
                                                                id="email">
                                                            </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="password"> Password </label>
                                                              <input  class="form-control" type="password" name="password"   id="password" placeholder="password">
                                                            </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                              <label for="c_password"> Confirm Password </label>
                                                              <input  class="form-control" type="password" name="password_confirmation"   id="c_password" placeholder="Confirm password">
                                                            </div>
                                                          </div>
                        


                                                          <div class="col-sm-12 col-md-6">

                                                            <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                                                   id="exampleCheck1"  style="margin-left: 10px;margin-right: 10px">
                                                            <label class="" for="exampleCheck1"
                                                                  style="margin-left: 30px;margin-right: 30px">Show Password </label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            
                                        </div>
                                    </div>
                                </section>


                            




             </div>
                                            <center>
                                                <button type="submit" class=" mt-3 px-5 btn btn-info shadow rounded-10">
                                                    Submit
                                                </button>
                                                &nbsp;&nbsp;&nbsp;
                                                <a class=" shadow btn px-5 mt-3 text-white btn-success  px-3 s-rounded rounded-10" href="<?php echo e(url()->previous()); ?>"> Close </a>
                                            </center>
             </form>

         </div>
     </div>
  </div>
 </div>
           


            </div>


<!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
@toastr_js
@toastr_render

 

</div>





<script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("c_password");
            if ((x.type === "password")&&(y.type === "password")){
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mnira\Downloads\emotion_final_v2\emotion\resources\views/managers/profile.blade.php ENDPATH**/ ?>