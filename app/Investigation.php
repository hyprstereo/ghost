<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Profile;

class Investigation extends Model
{
    protected $fillable = ['date', 'status', 'case_no', 'location', 'station', 'raid_leader_id', 'profile_id',
    'complainer_date_time', 'complainer_place_of_offence', 'complainer_name', 'complainer_report_no', 'profiles'];

    public function getProfiles() {
        $profile_id = $this->profile_id;
        $arr = explode(',', $profile_id);
        $res = array();
        for ($i = 0; $i < count($arr); $i++) {
            $p = Profile::where('id', '=', $arr[$i])->first();
            array_push ($res, $p);
        }
        return $res;
    }
}
