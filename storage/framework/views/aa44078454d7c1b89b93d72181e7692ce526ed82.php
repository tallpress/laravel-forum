<hr>
  <div class="card">
      <div class="card-header">
        <a href="#"><?php echo e($reply->owner->name); ?></a> said <?php echo e($reply->created_at->diffForHumans()); ?>

      </div>
      <div class="card-body">
        <?php echo e($reply->body); ?>

      </div>
  </div>
