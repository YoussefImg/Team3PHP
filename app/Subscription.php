<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'Subscription';

    protected $primaryKey = 'SubscriptionID';
    public $timestamps = false;

    protected $hidden = ['RouteID', 'DiscountID'];
    protected $guarded = ['SubscriptionID'];
    protected $fillable = ['RailcardID', 'RouteID', 'DiscountID', 'ValidFrom', 'ValidUntil'];

    protected $appends = ['Route', 'Discount'];

    public function getRouteAttribute()
    {
        return Route::find($this->RouteID);
    }

    public function getDiscountAttribute()
    {
        return Discount::find($this->DiscountID);
    }
}
