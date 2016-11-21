<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationWithAddress extends Model
{
    protected $table = 'Station';

    protected $primaryKey = 'StationID';
    public $timestamps = false;

    protected $hidden = ['AddressID'];
    protected $guarded = ['StationID'];
    protected $fillable = ['AddressID', 'Name'];

    protected $appends = ['Address'];

    public function getAddressAttribute()
    {
        return Address::find($this->AddressID);
    }
}
