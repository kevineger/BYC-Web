<div class="comment">
    <a class="avatar">
        <img src="http://semantic-ui.com/images/avatar2/small/molly.png">
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