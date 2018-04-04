<div class="card">

    <div class="card-header">
        <?php echo e($profileUser->name); ?> replied to
        <a href="<?php echo e($activity->subject->thread->path()); ?>">
            <?php echo e($activity->subject->thread->title); ?>

        </a>
      <?php echo e($activity->subject->created_at->diffForHumans()); ?>

    </div>

    <div class="card-body">
        <?php echo e($activity->subject->body); ?>

    </div>
    
</div>
