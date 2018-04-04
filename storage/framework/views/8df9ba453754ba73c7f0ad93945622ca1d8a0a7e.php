<div class="card">

    <div class="card-header">
        <?php echo e($profileUser->name); ?> favorited a <a href="<?php echo e($activity->subject->favorited->path()); ?>">reply</a>
        
      <?php echo e($activity->subject->created_at->diffForHumans()); ?>

    </div>

    <div class="card-body">
        <?php echo e($activity->subject->favorited->body); ?>

    </div>
</div>
