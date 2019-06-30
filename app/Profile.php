<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['type', 'name', 'race', 'identification', 'occupation', 'photo_id'];
}
