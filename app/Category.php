<?php

namespace healthy;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function notes(){
        return $this->hasMany(Note::class);
    }

}
