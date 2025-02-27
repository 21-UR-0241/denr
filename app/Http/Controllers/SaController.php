<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sa;
use Schema;

class SaController extends Controller
{
    public function sa(){
        $sadata = sa::all();
        
        return view('admin.sa', compact('sadata'));
    }

    public function addsa(Request $request)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $insert = DB::table('sa')->insert([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
            'on_process_rejected_approve' => $request->status,
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

    public function updatesa(Request $request, $id_sa)
    {
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'status' => 'required|in:on process,rejected,approved',
            'remarks' => 'nullable|string',
        ]);

        $update = DB::table('sa')->where('id_sa', $id_sa)->update([
            'applicant_name' => $request->applicantname,
            'applicant_number' => $request->applicantnumber,
            'location' => $request->location,
            'survey_no' => $request->surveynumber,
            'on_process_rejected_approve' => $request->status,
            'remarks' => $request->remarks,
        ]);
            if($update){
                return back()->with('success', 'Application updated successfully!');
            }
            else{
                return back()->with('error', 'An error occurred while updating the record.');
            }
        
    }

    public function deletesa($id_sa)
    {
        // $msa = msa::where($id_msa, 'id_msa')->first();

        // if ($msa) {
        //     $msa->delete();
        //     return back()->with('success', 'Record deleted successfully.');
        // }

        // return back()->with('error', 'Record not found.');

        $deleted = DB::table('sa')->where('id_sa', $id_sa)->delete();

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
