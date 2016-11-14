<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'Customer';

    protected $primaryKey = 'CustomerID';
    public $timestamps = false;

    protected $hidden = ['AddressID', 'RailCardID'];
    protected $guarded = ['CustomerID'];
    protected $fillable = ['AddressID', 'RailCardID', 'FirstName', 'LastName', 'BirthDate', 'Email'];

    protected $appends = ['Address', 'RailCard'];

    public function getAddressAttribute()
    {
        return Address::find($this->AddressID);
    }

    public function getRailCardAttribute()
    {
        return RailCard::find($this->RailCardID);
    }
}
