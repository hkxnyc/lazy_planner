<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';
    protected $primaryKey = 'slug';
    protected $fillable = [
      'slug','data'
    ];

    protected $casts = [
        'data'=>'object'
    ];


    public static function createNewSearch($data)
    {
        $s = new Search();
        $s->slug = str_random(16);

        $s->data = $data;
        $s->save();
        return $s;
    }
}
