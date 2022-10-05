<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;



    

    public function countryToPost(){
        return $this->hasManyThrough("App\Models\Post", "App\Models\User");
        //默認("App\Models\Post", "App\Models\User", "User_id", "country_id");
    }
}
