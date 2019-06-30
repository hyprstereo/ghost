<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $fillable = ['date', 'status', 'case_no', 'location', 'station', 'raid_leader_id', 'profile_id',
    'complainer_date_time', 'complainer_place_of_offence', 'complainer_name', 'complainer_report_no'];
}
