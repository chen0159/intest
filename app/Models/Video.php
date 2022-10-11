<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;




    //polymorphic methods many to many
    public function videoToTag(){

        return $this->morphToMany('App\Models\Tag', 'taggable');

    }

}
