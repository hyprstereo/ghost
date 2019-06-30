<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Officer;

class ProfilesController extends Controller
{
    public function getOfficers(Request $request) {
        $officers = Officer::all();
        return $officers;
    }
}
