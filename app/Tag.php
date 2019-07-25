<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name'];

    // $tag->posts
    //dohvati sve postove koji su označeni tagom
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
        
        //umjesto da vraća id gore u url neka vrati njegovo ime
    public function getRouteKeyName(){

        return 'name';
    }
}
