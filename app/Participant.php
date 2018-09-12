<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'phone', 'role', 'country', 'group_id'];
}
