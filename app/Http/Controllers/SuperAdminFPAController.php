<?php

namespace App\Http\Controllers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Fpa;
use Schema;


class SuperAdminFPAController extends Controller
{
    //

    public function fpa(){
        $fpadata = fpa::all();
        
        return view('superadmin.fpa', compact('fpadata'));


    }
    
    public function addfpa(Request $request)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'refferedinvestigator' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $insert = DB::table('fpa')->insert([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
            'reffered_investigator' => $request->refferedinvestigator,
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


    public function updatefpa(Request $request, $id_fpa)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'refferedinvestigator' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'status' => 'required|in:subsisting,patented',
            'remarks' => 'nullable|string',
        ]);

        $update = DB::table('fpa')->where('id_fpa', $id_fpa)->update([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
            'reffered_investigator' => $request->refferedinvestigator,
            'location' => $request->location,
            'survey_no' => $request->surveynumber,
            'patented_subsisting' => $request->status,
            'remarks' => $request->remarks,
        ]);
if($update){
    return back()->with('success', 'Application updated successfully!');
}
else{
    return back()->with('error', 'An error occurred while updating the record.');
}
        
    }

    public function deletefpa($id_fpa)
    {
        // $msa = msa::where($id_msa, 'id_msa')->first();

        // if ($msa) {
        //     $msa->delete();
        //     return back()->with('success', 'Record deleted successfully.');
        // }

        // return back()->with('error', 'Record not found.');

        $deleted = DB::table('fpa')->where('id_fpa', $id_fpa)->delete();

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
