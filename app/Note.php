<?php

namespace healthy;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    protected  $fillable =['note'];

    public function category(){

        return $this->belongsTo(Category::class);

    }
    //
}
