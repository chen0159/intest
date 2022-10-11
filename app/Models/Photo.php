<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;




    //polymorphic methods
    public function inversePhoto(){
        return $this->morphTo('imageable');
    }
}
