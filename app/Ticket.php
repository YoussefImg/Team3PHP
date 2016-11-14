<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'Ticket';

    protected $primaryKey = 'TicketID';
    public $timestamps = false;

    protected $hidden = ['RouteID'];
    protected $guarded = ['TicketID'];
    protected $fillable = ['RouteID', 'Date', 'Price', 'ValidFrom', 'ValidUntil', 'ComfortClass'];

    protected $appends = ['Route'];

    public function getRouteAttribute()
    {
        return Route::find($this->RouteID);
    }
}
