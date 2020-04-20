<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id','description', 'location', 'from_date', 'to_date'];

    public $timestamps = false;
}
