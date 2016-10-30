<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'lines';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'picture_url',
        'info_url',
    ];

    public function stations()
    {
        return $this->belongsToMany('App\Station','line_station');
    }
}
