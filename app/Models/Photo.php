<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;



    //16
    protected $fillable = ['name'];
    //

    //polymorphic methods
    public function inversePhoto(){
        return $this->morphTo('imageable');
    }
}
