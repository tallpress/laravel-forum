<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e($profileUser->name); ?></div>
                <div class="card-body">
                  <h6><?php echo e($profileUser->name . "\'s threads"); ?></h6>
                  <br>
                  <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card">
                        <div class="card-header">
                          <strong>
                            <a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->title); ?></a>
                          </strong> was published by <?php echo e($thread->creator->name); ?>

                          <?php echo e($thread->created_at->diffForHumans()); ?>

                        </div>
                        <div class="card-body">
                          <?php echo e($thread->body); ?>

                        </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php echo e($threads->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>