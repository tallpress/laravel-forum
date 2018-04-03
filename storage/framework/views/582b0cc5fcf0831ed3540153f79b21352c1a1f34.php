<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                  <?php $__empty_1 = true; $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article>
                      <h4>
                        <a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->title); ?></a>
                      </h4>
                      <h6><a href="/profiles/<?php echo e($thread->creator->name); ?>"><?php echo e($thread->creator->name); ?></a></h6>
                      <strong><?php echo e($thread->created_at->diffForHumans()); ?></strong>

                      <p>
                        <?php echo e($thread->body); ?>

                      </p>

                      <a href="<?php echo e($thread->path()); ?>">
                        <p><?php echo e($thread->replies_count); ?> <?php echo e(str_plural('reply', $thread->replies_count)); ?></p>
                      </a>
                    </article>
                  <hr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>
                      There are no related results at this time.
                    </p>
                  <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>