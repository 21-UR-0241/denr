<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\msa;
use Schema;

class MsaController extends Controller
{
    //

    public function msa(){
        $msadata = msa::all();
        
        return view('admin.msa', compact('msadata'));
    }

    public function addmsa(Request $request)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $insert = DB::table('msa')->insert([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
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

    public function update(Request $request, $id_msa)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'status' => 'required|in:subsisting,patented',
            'remarks' => 'nullable|string',
        ]);

        $update = DB::table('msa')->where('id_msa', $id_msa)->update([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
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

    public function delete($id_msa)
    {
        // $msa = msa::where($id_msa, 'id_msa')->first();

        // if ($msa) {
        //     $msa->delete();
        //     return back()->with('success', 'Record deleted successfully.');
        // }

        // return back()->with('error', 'Record not found.');

        $deleted = DB::table('msa')->where('id_msa', $id_msa)->delete();

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
