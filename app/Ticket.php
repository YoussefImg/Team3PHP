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
    protected $fillable = ['RouteID', 'TypeTicketID','Date', 'Price', 'ValidFrom', 'ValidUntil', 'ComfortClass'];

    protected $appends = ['Route', 'TypeTicketID'];

    public function getRouteAttribute()
    {
        return Route::find($this->RouteID);
    }

    public function getTypeTicketAttribute()
    {
        return TypeTicket::find($this->TypeTicketID);
    }
}
