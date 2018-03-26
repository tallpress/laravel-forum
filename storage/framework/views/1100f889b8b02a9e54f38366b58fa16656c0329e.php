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
                              <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>

                              <label for="channel_id">Choose a channel</label>
                              <select class="form-control" name="channel_id" id="channel_id">
                                <option>Choose one...</option>
                                <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($channel->id); ?>"><?php echo e($channel->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>

                              <label for="body">Body: </label>
                              <textarea name="body" rows="8" class="form-control" value="<?php echo e(old('body')); ?>" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                        <?php else: ?>
                        <p>Please <a href="<?php echo e(route('login')); ?>">sign in</a> to publish a new thread</p>
                        <?php endif; ?>

                        <?php if(count($errors)): ?>
                        <ul class='alert alert-danger'>
                          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
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