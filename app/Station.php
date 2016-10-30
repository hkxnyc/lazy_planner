<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    //

    public $timestamps = false;

    protected $fillable = [
        'name',
        'longitude',
        'latitude'
    ];


    public function lines()
    {
        return $this->belongsToMany('App\Line','line_station');
    }

    public function positionArray()
    {
        return ['longitude'=>$this->longitude,'latitude'=>$this->latitude];
    }
}
