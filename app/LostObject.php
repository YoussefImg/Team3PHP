<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LostObject extends Model
{
    protected $table = 'LostObject';

    protected $primaryKey = 'ObjectID';
    public $timestamps = false;

    protected $hidden = ['StationID'];
    protected $guarded = ['ObjectID'];
    protected $fillable = ['StationID', 'Description', 'Date', 'TrainID'];

    protected $appends = ['Station'];

    public function getStationAttribute()
    {
        return Station::find($this->StationID);
    }
}
