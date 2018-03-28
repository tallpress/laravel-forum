<hr>
  <div class="card">
      <div class="card-header">
        <a href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}
      </div>
      <div class="">
        <form class="" action="/replies/{{ $reply->id }}/favorites" method="POST">
          {{ csrf_field() }}
          <button class="btn btn-info" type="submit" name="favoirte" {{ $reply->isFavorited() ? 'disabled' : '' }} >
            {{ $reply->getFavoriteCountAttribute() }} {{ str_plural('Favorite', $reply->getFavoriteCountAttribute())}}
          </button>
        </form>
      </div>
      <div class="card-body">
        {{ $reply->body }}
      </div>
  </div>
