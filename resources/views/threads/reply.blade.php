<hr>
  <div class="card" id="reply-{{ $reply->id }}">
      <div class="card-header">
        <a href="/profiles/{{$reply->owner->name}}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}
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

      @if ($reply->user_id == auth()->id())
          <div class="card-footer">
              <form action="/replies/{{ $reply->id }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-danger" name="delete" >Delete</button>
              </form>
          </div>
      @endif

  </div>
