<?php $__env->startSection('css'); ?>
    


<?php $__env->startSection('page-header'); ?>
<!-- breadcrumb -->
<?php $__env->startSection('PageTitle'); ?>
My Old Posts
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
               New Post
            </button>
            <br><br>
 

  
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            
                            <th>ID</th>
                            <th>Hospital</th>
                            <th>Department</th>
                            <th>Content</th>
                            <th>Replay</th>
                            <th>Added At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $i++; ?>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($post->hospital->hospital); ?></td>
                                <td><?php echo e($post->department); ?></td>
                                
                                <td> <?php echo e(Str::limit($post->content,20,$end=' .....')); ?></td>
                                
                                <td> <?php echo e(Str::limit($post->replay,20,$end=' .....')); ?></td>
                                <td><?php echo e($post->created_at); ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm rounded-10" data-toggle="modal"
                                        data-target="#show<?php echo e($post->id); ?>"
                                        title="Details"><i class="fa fa-eye"></i></button>


                                    

                                        <button type="button" class="btn btn-success btn-sm rounded-10" data-toggle="modal"
                                        data-target="#emotion<?php echo e($post->id); ?>"
                                        title="Emotion"><i
                                            class="fa fa-check"></i></button>

                                </td>
                            </tr>
      
                            <!-- edit_modal_post -->
                            <div class="modal fade" id="show<?php echo e($post->id); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Update post Data
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit_form -->
                                            
                                                
                                                <?php echo csrf_field(); ?>

                                                        <fieldset class="row" >
                                                            
                                                            <div class="col-6 col-md-12">
                                                                <div class="form-group">
                                                                  <label for="hospital ">Hospital</label>
                                                                  <select readonly class="form-control" name="hospital_id">
                                                                    <option selected value="<?php echo e($post->hospital->id); ?>" ><?php echo e($post->hospital->hospital); ?> </option>
                                                                    
                                                                </select>
                                                                </div>
                                                              </div>

                                                            <div class="col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                  <label for="department">Department</label>
                                                                  <input readonly type="text"  name="department" class="form-control" id="department" value="<?php echo e($post->department); ?>">
                                                                </div>
                                                            </div>

                                                             <div class="col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                  <label for="traetment_date">Date</label>
                                                                  <input readonly type="datetime-local"  name="traetment_date" class="form-control" id="traetment_date" value="<?php echo e($post->traetment_date); ?>">
                                                                </div>
                                                            </div>

                                                               <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                          <label for="content"> Description </label>
                                                                          <textarea readonly class="form-control"  name="content" id="content"  rows="3"><?php echo e($post->content); ?></textarea>
                                                                 </div>
                                                              </div>

                                                              <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                          <label for="replay"> Replay </label>
                                                                          <textarea readonly class="form-control"  name="replay" id="replay"  rows="3"><?php echo e($post->replay); ?></textarea>
                                                                 </div>
                                                              </div>


                                                        </fieldset>


                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-secondary rounded-10"
                                                        data-dismiss="modal">Close</button>
                                                    
                                                </div>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
           
            

                            <!-- delete_modal_post -->
                            <div class="modal fade" id="delete<?php echo e($post->id); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                Delete post Account
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="post" enctype="multipart/form-data">
                                                <?php echo e(method_field('Delete')); ?>

                                                <?php echo csrf_field(); ?>
                                                Are you sure you want to delete this account ?
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="<?php echo e($post->id); ?>">
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

                  

  

                            <!-- emotion_modal_post -->
                            <div class="modal fade" id="emotion<?php echo e($post->id); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                View Post Emotion
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                               The Emotin Generated For THis Post Is:<br>
                                               
                                               <?php echo e($post->result); ?>


                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-secondary rounded-10"
                                                        data-dismiss="modal">Close</button>
                                                    
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


 

<!-- add_modal_post -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add New Post
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="<?php echo e(route('posts.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <fieldset class="row" >
                        <input type="hidden" value="<?php echo e(session('user')->id); ?>" name="visitor_id">

                        <div class="col-6 col-md-12">
                            <div class="form-group">
                              <label for="hospital ">Hospital</label>
                              <select required class="form-control" name="hospital_id">
                                
                                <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" ><?php echo e($item->hospital); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                          </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <label for="department">Department</label>
                              <input required type="text"  name="department" class="form-control" id="department" autofocus>
                            </div>
                        </div>

                         <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <label for="traetment_date">Date</label>
                              <input required type="datetime-local"  name="traetment_date" class="form-control" id="traetment_date" autofocus>
                            </div>
                        </div>

                           <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                      <label for="content"> Description </label>
                                      <textarea required class="form-control"  name="content" id="content"  rows="3"> </textarea>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mnira\Downloads\emotion_final_v2\emotion\resources\views/posts/visitor_old.blade.php ENDPATH**/ ?>