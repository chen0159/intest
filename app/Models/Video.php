<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ["name"];



    //polymorphic methods many to many
    public function videoToTag(){

        return $this->morphToMany('App\Models\Tag', 'taggable');

    }

}
