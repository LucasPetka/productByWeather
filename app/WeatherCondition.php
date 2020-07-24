<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherCondition extends Model
{
    protected $table = 'weather_conditions';
    public $timestamps = false;
}
