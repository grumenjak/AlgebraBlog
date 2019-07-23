<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
        // $tag->posts
        //dohvati sve postove koji su označeni tagom
        public function posts(){
            return $this->belongsToMany(Post::class);
        }
}
