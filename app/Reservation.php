<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'Reservation';

    protected $primaryKey = 'ReservationID';
    public $timestamps = false;

    protected $hidden = ['RouteID'];
    protected $guarded = ['ReservationID'];
    protected $fillable = ['PassengerCount', 'TrainID', 'Price', 'RouteID'];

    protected $appends = ['Route'];

    public function getRouteAttribute()
    {
        return Route::find($this->RouteID);
    }
}
