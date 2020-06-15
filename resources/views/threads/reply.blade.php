<div class="card mt-4">
    <div class="card-header">
        <div class="level">
            <span class="flex"><a href="">
                    {{$reply->owner->name}}
                </a>
                said {{$reply->created_at->diffForHumans()}}
            </span>

            <div>

                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary" {{ $reply->isFavorited() ? 'disabled':'' }}>
                        {{$reply->favorites_count}}
                        {{Str::plural('Favorite',$reply->favorites_count)}}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>
