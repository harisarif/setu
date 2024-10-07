<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtendCampaign extends Model
{
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

   
}
