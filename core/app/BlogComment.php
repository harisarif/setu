<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $guarded = [];

    public function blog(){
        return $this->belongsTo(SuccessStory::class,'success_story_id');
    }
}
