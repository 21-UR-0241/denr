<?php

namespace App\Http\Controllers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sp;
use Schema;

class SpController extends Controller
{
    public function sp(){
        $spdata = sp::all();
        
        return view('admin.sp', compact('spdata'));
    }

    public function addsp(Request $request)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'refferedinvestigator' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'sector' => 'required|string',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $insert = DB::table('sp')->insert([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
            'reffered_investigator' => $request->refferedinvestigator,
            'sector' => $request->sector,
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

    public function updatesp(Request $request, $id_sp)
{
    $request->validate([
        'applicantname' => 'required|string|max:255',
        'applicantnumber' => 'required|string|max:100',
        'refferedinvestigator' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'surveynumber' => 'required|string|max:100',
        'sector' => 'required|string',
        'status' => 'required|string',
        'remarks' => 'nullable|string',
    ]);
    $update = DB::table('sp')->where('id_sp', $id_sp)->update([
        'applicant_name' => $request->applicantname,
        'applicant_number' => $request->applicantnumber,
        'patented_subsisting' => $request->status,
        'reffered_investigator' => $request->refferedinvestigator,
        'location' => $request->location,
        'sector' => $request->sector,
        'survey_no' => $request->surveynumber,
        'remarks' => $request->remarks
    ]);
    if ($update) {
        return back()->with('success', 'Record updated successfully.');
    } else {
        return back()->with('error', 'An error occurred while updating the record.');
    }
}


    public function deletesp($id_sp)
    {
        // $msa = msa::where($id_msa, 'id_msa')->first();

        // if ($msa) {
        //     $msa->delete();
        //     return back()->with('success', 'Record deleted successfully.');
        // }

        // return back()->with('error', 'Record not found.');

        $deleted = DB::table('sp')->where('id_sp', $id_sp)->delete();

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
