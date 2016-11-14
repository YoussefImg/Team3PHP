<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'Staff';

    protected $primaryKey = 'StaffID';
    public $timestamps = false;

    protected $hidden = ['AddressID', 'StationID', 'Password', 'remember_token', 'Api_token'];
    protected $guarded = ['StaffID'];
    protected $fillable = ['FirstName', 'LastName', 'UserName', 'Password', 'Rights', 'BirthDate', 'Email', 'Api_token'];

    protected $appends = ['Address', 'Station'];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getAuthIdentifier()
    {
        return $this->UserName;
    }

    public function getAddressAttribute()
    {
        return Address::find($this->AddressID);
    }

    public function getStationAttribute()
    {
        return Address::find($this->StationID);
    }
}
