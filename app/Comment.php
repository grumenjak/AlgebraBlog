<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'body', 'user_id', 'post_id',
    ];

    // $comment->post
    public function post(){
        //jedan komentar pripada jednom postu
        return $this->belongsTo(Post::class);
    }

    // $comment->user
    public function user(){
        //svaki komentar pripada useru
        return $this->belongsTo(User::class);
    }
}
