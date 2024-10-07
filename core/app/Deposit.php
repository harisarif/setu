<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposits';
    protected $guarded = ['id'];

    protected $casts = [
        'detail' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'method_code', 'code');
    }

    // scope
    public function scopeGateway_currency()
    {
        return GatewayCurrency::where('method_code', $this->method_code)->where('currency', $this->method_currency)->first();
    }

    public function scopeBaseCurrency()
    {
        return $this->gateway->crypto == 1 ? 'USD' : $this->method_currency;
    }

    public function scopePending()
    {
        return $this->where('status', 2);
    }


    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function userId()
    {
        return $this->hasManyThrough(User::class, Campaign::class, 'user_id', 'campaign_id', 'id', 'id');
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
