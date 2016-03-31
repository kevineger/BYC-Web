<div class="comment">
    <a class="avatar">
        @if($comment->user->photos()->count() > 0)
            <img src="/{{ $comment->user->photos()->first()->thumbnail_path }}" alt="Photo">
        @else
            {{--<img src="/photos/default-icon.jpg" alt="Photo">--}}
            <i class="circular user icon"></i>
        @endif
    </a>
    <div class="content">
        <a class="author">{{$comment->user->name}}</a>
        <div class="metadata">
            <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <div class="text">
            {{$comment->text}}
        </div>
    </div>
</div>