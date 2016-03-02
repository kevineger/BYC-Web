<?php namespace App\Transformers;

class CommentTransformer extends Transformer {

    public function transform($comment)
    {
        $username = $comment->user->name;

        return [
            'user' => $username,
            'text' => $comment['text'],
            'time' => $comment->created_at
        ];
    }
}