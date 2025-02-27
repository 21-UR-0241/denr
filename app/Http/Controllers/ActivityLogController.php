<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function showActivityLog()
{
    // Fetch all activity log entries, or filter by application type if needed
    $activityLogs = DB::table('activitylog')->orderBy('datetime', 'desc')->get();

    // Pass the logs to the view
    return view('superadmin.activityLog', compact('activityLogs'));
}

}
