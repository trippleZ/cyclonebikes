<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bicycle extends Model {

    protected $fillable = ['name', 'wheel_size', 'description'];

    public function types()
    {
        return $this->belongsToMany('App\Type', 'bicycle_type', 'bike_id');
    }

    public function colors()
    {
        return $this->hasMany('App\Colors');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute', 'parts')->withPivot('attribute_value', 'id');
    }

}