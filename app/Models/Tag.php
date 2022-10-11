<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;




    //polymorphic method mmany to many
    public function tagToPost(){
        
        return $this->morphedByMany('App\Models\Post', 'taggable');

    }
    
    public function tagToVideo(){
        
        return $this->morphedByMany('App\Models\Video', 'taggable');

    }
}
