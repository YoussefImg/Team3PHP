<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    protected $connection = 'nmbs_mysql';

    protected $table = 'Staff';

    protected $primaryKey = 'StaffID';

    public $timestamps = false;

    protected $fillable = ['AdressID', 'StationID', 'FirstName', 'LastName', 'UserName', 'Password', 'Rights', 'BirthDate', 'Email'];
    protected $guarded = ['StaffID'];


}
