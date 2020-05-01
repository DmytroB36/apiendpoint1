<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalorieBalance extends Model
{
    public $timestamps = false;

    const TYPE_BURNED = 'burned';
    const TYPE_INTAKEN = 'intaken';
}
