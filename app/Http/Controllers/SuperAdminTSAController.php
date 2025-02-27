<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tsa;
use Schema;


class SuperAdminTSAController extends Controller
{
    public function tsa(){
        $tsadata = tsa::all();
        
        return view('superadmin.tsa', compact('tsadata'));
    }

    public function addtsa(Request $request)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'clearedold' => 'required|string',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $insert = DB::table('tsa')->insert([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
            'cleared_old' => $request->clearedold,
            'patented_subsisting' => $request->status,
            'location' => $request->location,
            'survey_no' => $request->surveynumber,
            'remarks' => $request->remarks
        ]);
    

        if($insert){
            return back()->with('success', 'Application added successfully');
        }
        else{
            return back()->with('error', 'An error ocurrec while updating the record.');
        }
    }

    public function updatetsa(Request $request, $id_tsa)
{
    $request->validate([
        'applicantname' => 'required|string|max:255',
        'applicantnumber' => 'required|string|max:100',
        'location' => 'required|string|max:255',
        'surveynumber' => 'required|string|max:100',
        'clearedold' => 'required|string',
        'status' => 'required|string',
        'remarks' => 'nullable|string',
    ]);
    $update = DB::table('tsa')->where('id_tsa', $id_tsa)->update([
        'applicant_name' => $request->applicantname,
        'applicant_number' => $request->applicantnumber,
        'patented_subsisting' => $request->status,
        'location' => $request->location,
        'cleared_old' => $request->clearedold,
        'survey_no' => $request->surveynumber,
        'remarks' => $request->remarks
    ]);
    if ($update) {
        return back()->with('success', 'Record updated successfully.');
    } else {
        return back()->with('error', 'An error occurred while updating the record.');
    }
}


    public function deletetsa($id_tsa)
    {
        // $msa = msa::where($id_msa, 'id_msa')->first();

        // if ($msa) {
        //     $msa->delete();
        //     return back()->with('success', 'Record deleted successfully.');
        // }

        // return back()->with('error', 'Record not found.');

        $deleted = DB::table('tsa')->where('id_tsa', $id_tsa)->delete();

        if ($deleted) {
            return back()->with('success', 'Record successfully deleted.');
        } else {
            return back()->with('error', 'Record not found.');
        }
   
   if($deleted){
    return back()->with('success', 'Record successfully deleted.');
   }
   else{
    return back()->with('error', 'Record not found.');
   }
    }
}
