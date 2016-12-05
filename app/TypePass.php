<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePass extends Model
{
    protected $table = 'TypePass';

    protected $primaryKey = 'TypePassID';
    public $timestamps = false;


    protected $guarded = ['TypePassID'];
    protected $fillable = ['Name'];

}
