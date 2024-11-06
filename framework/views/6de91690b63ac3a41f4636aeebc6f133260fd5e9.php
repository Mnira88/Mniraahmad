<?php $__env->startSection('css'); ?>
    


<?php $__env->startSection('page-header'); ?>
<!-- breadcrumb -->
<?php $__env->startSection('PageTitle'); ?>
Manager Accounts
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

            <button type="button" class="button x-small rounded-10" data-toggle="modal" data-target="#exampleModal">
               New manager
            </button>
            <br><br>
 

  
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Added At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $i++; ?>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($manager->name); ?></td>
                                <td><?php echo e($manager->email); ?></td>
                                <td><?php echo e($manager->phone); ?></td>
                                <td><?php echo e($manager->created_at); ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm rounded-10" data-toggle="modal"
                                        data-target="#edit<?php echo e($manager->id); ?>"
                                        title="Update"><i class="fa fa-edit"></i></button>


                                    <button type="button" class="btn btn-danger btn-sm rounded-10" data-toggle="modal"
                                    data-target="#delete<?php echo e($manager->id); ?>"
                                    title="Delete"><i
                                        class="fa fa-trash"></i></button>


                                </td>
                            </tr>
      
                            <!-- edit_modal_manager -->
                            <div class="modal fade" id="edit<?php echo e($manager->id); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Update Manager Data
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit_form -->
                                            <form action="<?php echo e(route('managers.update', $manager->id)); ?>" method="post" enctype="multipart/form-data">
                                                <?php echo e(method_field('patch')); ?>

                                                <?php echo csrf_field(); ?>
                                                        <fieldset class="row" >
                                                            <input type="hidden" value="1" name="role_id">
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input required type="text" name="name" class="form-control" id="name" value="<?php echo e($manager->name); ?>" autofocus>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                <label for="lastname">Last Name</label>
                                                                <input required type="text" name="hospital" class="form-control" id="hospital" value="<?php echo e($manager->hospital); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                <label for="phone">Phone</label>
                                                                <input required  type="number" pattern="[0-9]*" class="form-control" name="phone" id="phone"
                                                                    placeholder="Ex.05xxxxxxxx" value="<?php echo e($manager->phone); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                <label for="email"> Email </label>
                                                                <input required class="form-control" type="email" name="email" placeholder="your email"
                                                                    id="email" value="<?php echo e($manager->email); ?>">
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

                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-secondary rounded-10"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-success rounded-10">Submit </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
           
            

                            <!-- delete_modal_manager -->
                            <div class="modal fade" id="delete<?php echo e($manager->id); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Delete Manager Account
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo e(route('managers.destroy', $manager->id)); ?>" method="post" enctype="multipart/form-data">
                                                <?php echo e(method_field('Delete')); ?>

                                                <?php echo csrf_field(); ?>
                                                Are you sure you want to delete this account ?
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="<?php echo e($manager->id); ?>">
                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-secondary rounded-10"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-danger rounded-10">Submit </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                  


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
           
            </div>
        </div>
    </div>
</div>


 

<!-- add_modal_manager -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add Manager Account
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="<?php echo e(route('managers.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <fieldset class="row" >
                        <input type="hidden" value="2" name="role_id">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input required type="text"  name="name" class="form-control" id="name" autofocus>
                            </div>
                        </div>
                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="Hospital">Hospital</label>
                              <input required type="text"  name="hospital" class="form-control" id="hospital" >
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
            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary rounded-10"
                    data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success rounded-10">Submit </button>
            </div>
            </form>

        </div>
    </div>
</div>

</div>

<!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
@toastr_js
@toastr_render
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mnira\Downloads\emotion_final_v2\emotion\resources\views/managers/index.blade.php ENDPATH**/ ?>