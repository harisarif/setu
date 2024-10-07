<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function donation(){
        return $this->hasMany(Donation::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }


    public function scopeFilters($query, $filters){
        if($category = @$filters){
            $query->whereHas('category',function($q) use($category){
                $q->where('name',$category);
            });
        }
    }
    
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(" ", '-',$value);
    }

    

    public function getAddressAttribute()
    {
        return $this->user->address->address.' ,'. $this->user->address->city.', '. $this->user->address->state .', '. $this->user->address->zip.', '. $this->user->address->country.'.' ;
    }

    

    protected $casts = [
        'image_prof' => 'json',
    ];


}
