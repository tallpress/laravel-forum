<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <a href="#"><?php echo e($thread->creator->name); ?></a><strong><?php echo e($thread->title); ?></strong></div>

                <div class="card-body">
                  <?php echo e($thread->body); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
          <?php $__currentLoopData = $thread->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('threads.reply', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>


    <?php if(auth()->check()): ?>
      <div class="row justify-content-center">
          <div class="col-md-8">
            <form action="/threads/<?php echo e($thread->id); ?>/replies" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <textarea placeholder="Comment here..." name="body" rows="8" cols="80" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Post</button>
            </form>
          </div>
      </div>
    <?php else: ?>
      <p>Please <a href="<?php echo e(route('login')); ?>">sign in</a> to comment</p>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>