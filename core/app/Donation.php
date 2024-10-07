<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $guarded = ['id'];


    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

    public function deposite(){
        return $this->hasOne(Deposit::class);
    }

    public function scopeFilter($query,$filters)
    {
        
        
        if($donor = @$filters){

            $query->whereHas('campaign',function($q) use ($donor){
                $q->where('id',$donor['counter']);
            });
        }
    }


    
}
