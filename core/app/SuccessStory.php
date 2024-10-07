<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    protected $table = 'success_stories';
    protected $guarded = []; 

    public function comment(){
        return $this->hasMany(BlogComment::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $filters)
    {
        if($month = @$filters['month']){
            $query->whereMonth('created_at',Carbon::parse($month)->month );
        }

        if($year = @$filters['year']){
            $query->whereYear('created_at',$year);
        }

        if($category = @$filters['category']){
            $query->whereHas('category',function($q) use ($category){
                $q->where('name',$category);
            });
        }
    }
}
