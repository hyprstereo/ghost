<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investigation;
use App\Profile;
use App\Officer;
use Carbon\Carbon;

class InvestigationController extends Controller
{

    public function newCase (Request $request) {
        $investigation = $request->all();
        //return $investigation['caseBookNo'];
        // set new profiles first
        $profiles = $this->processProfiles($investigation['profiles']);
        $details = $investigation['crimeDetails'];
        //return $details['complainer']['dateTime'];
        //return Carbon::parse($investigation['dateOpen']);

        $newInv = Investigation::create([
            'date' => Carbon::parse($investigation['dateOpen']),
            'status' => 0, // 0 = new
            'case_no' => $investigation['caseBookNo'],
            'location' => $investigation['location'],
            'station' => $investigation['station'],
            'raid_leader_id' => $investigation['teamLead'],
            'profile_id' => implode(',', $profiles),
            'complainer_date_time' => Carbon::parse($details['complainer']['dateTime']),
            'complainer_place_of_offence' => $details['complainer']['station'],
            'complainer_name' => $details['complainer']['name'],
            'complainer_report_no' => $details['complainer']['reportNo']
        ]);

        return $newInv;
    }

    public function processProfiles($profiles) {
        //return $profiles[0]['type'];
        $ret = array();

        for ($i = 0; $i < count($profiles); $i++) {

            $ident = ($profiles[$i]['type'] == 'private') ? $profiles[$i]['identity'] : $profiles[$i]['regNumber'];

            $profile = Profile::where('identification', '=', $ident)->first();
            if ($profile == null) {
                $profile = Profile::create([
                    'identification' => $ident
                 ]);
            }
            /*$profile = App\Profile::firstOrNew([
                'identification' => $ident
            ]);*/

            $profile->type = $profiles[$i]['type'];

            if ($profiles[$i]['type'] == 'private') {
                $profile->name = $profiles[$i]['name'];
                $profile->race = $profiles[$i]['race'];
                $profile->age = $profiles[$i]['age'];
                $profile->occupation = $profiles[$i]['occupation'];
            } else {
                $profile->name = $profiles[$i]['name'];
            }
            $profile->save();
            array_push($ret, $profile->id);
        }
        return $ret;
    }
}
