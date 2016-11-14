<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'Address';

    protected $primaryKey = 'AddressID';
    public $timestamps = false;

    protected $hidden = [];
    protected $guarded = ['AddressID'];
    protected $fillable = ['Street', 'Number', 'City', 'ZipCode', 'Coordinates'];

}
