<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <strong><?php echo e($thread->title); ?></strong> was published by <a href="/profiles/<?php echo e($thread->creator->name); ?>"><?php echo e($thread->creator->name); ?></a>
                  <?php if($thread->user_id == auth()->id()): ?>
                    <form class="" action="<?php echo e($thread->path()); ?>" method="POST">
                      <div class="form-group">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                      </div>
                    </form>
                  <?php endif; ?>
                </div>

                <div class="card-body">
                  <?php echo e($thread->body); ?>

                </div>
            </div>
            <?php $__currentLoopData = $replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo $__env->make('threads.reply', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <br>
            <?php echo e($replies->links()); ?>


            <?php if(auth()->check()): ?>
              <form action="<?php echo e($thread->path()); ?>/replies" method="POST">
                  <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                    <textarea placeholder="Comment here..." name="body" rows="8" cols="80" class="form-control"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Post</button>
              </form>
            <?php else: ?>
              <p>Please <a href="<?php echo e(route('login')); ?>">sign in</a> to comment</p>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <p>This thread was published on <strong><?php echo e($thread->created_at->toFormattedDateString()); ?></strong> by
                <a href="/profiles/<?php echo e($thread->creator->name); ?>"><strong><?php echo e($thread->creator->name); ?></strong></a> and currently has
                <strong><?php echo e($thread->replies_count); ?></strong> <?php echo e(str_plural('reply', $thread->replies_count )); ?>.
              </p>
            </div>
          </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>