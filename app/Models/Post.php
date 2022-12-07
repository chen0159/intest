<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//新增的
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;

    //新增的
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //

    //protected $table = 'posts';
    //當上面的class改名不叫Post時，此行可讓程式知道table仍是posts
    //protected $primaryKey = 'id';
    //同上，當初創的primaryKey叫id讓程式知道



    //
    protected $fillable = [
        'title123',
        'testtest123',
    ];
    //在route裡使用create方法新增DATA時，需要允許mass assignment;上面protected $fillable可解決

    public function pfunuser(){
        return $this->belongsTo('App\Models\User', 'user_id');
        //belongsTo=屬於誰的
    }


    //polymorphic methods
    public function yoursPhoto(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    //polymorphic methods many to many
    public function postToTag(){

        return $this->morphToMany('App\Models\Tag', 'taggable');

    }
    
    //20(新排列方式)
    public static function scopeNewLatest($query){
        return $query->orderBy('id', 'desc')->get();
    }
    //

}
