<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plane;
use Carbon\Carbon;
use App\Models\FlightReport;


class DashboardAgentController extends Controller
{
    public function showDashboard()

    {
        $planes = Plane::where('status', 'under maintenance')->get();

    }
}
