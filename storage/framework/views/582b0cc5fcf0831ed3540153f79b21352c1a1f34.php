<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                  <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article>
                      <h4>
                        <a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->title); ?></a>
                      </h4>

                      <h6><a href="#"><?php echo e($thread->creator->name); ?></a></h6>

                      <strong><?php echo e($thread->created_at->diffForHumans()); ?></strong>
                      <p>
                        <?php echo e($thread->body); ?>

                      </p>
                    </article>
                    <hr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>