<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    protected $table = 'Pass';

    protected $primaryKey = 'PassID';
    public $timestamps = false;

    protected $hidden = ['RouteID', 'TypePassID'];
    protected $guarded = ['PassID'];
    protected $fillable = ['RouteID', 'TypePassID', 'Date', 'StartDate', 'ComfortClass'];

    protected $appends = ['Route', 'TypePass'];

    public function getRouteAttribute()
    {
        return Route::find($this->RouteID);
    }

    public function getTypePassAttribute()
    {
        return TypePass::find($this->TypePassID);
    }
}
