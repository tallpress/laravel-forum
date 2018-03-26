<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a thread</div>

                <div class="card-body">
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                        <?php if(auth()->check()): ?>
                        <form action="/threads" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                              <label for="title">Title: </label>
                              <input type="text" name="title" class="form-control">

                              <label for="channel">Channel: </label>
                              <input type="text" name="channel" class="form-control">

                              <label for="body">Body: </label>
                              <textarea name="body" rows="8" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                        <?php else: ?>
                        <p>Please <a href="<?php echo e(route('login')); ?>">sign in</a> to publish a new thread</p>
                        <?php endif; ?>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>