<hr>
  <div class="card">
      <div class="card-header">
        <a href="#"><?php echo e($reply->owner->name); ?></a> said <?php echo e($reply->created_at->diffForHumans()); ?>

      </div>
      <div class="">
        <form class="" action="/replies/<?php echo e($reply->id); ?>/favorites" method="POST">
          <?php echo e(csrf_field()); ?>

          <button class="btn btn-info" type="submit" name="favoirte" <?php echo e($reply->isFavorited() ? 'disabled' : ''); ?> >
            <?php echo e($reply->getFavoriteCountAttribute()); ?> <?php echo e(str_plural('Favorite', $reply->getFavoriteCountAttribute())); ?>

          </button>
        </form>
      </div>
      <div class="card-body">
        <?php echo e($reply->body); ?>

      </div>
  </div>
