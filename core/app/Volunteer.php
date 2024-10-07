<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $casts = [
        'address' => 'object',
    ];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function getUsernameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

}
