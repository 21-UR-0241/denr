<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Fpa;
use Schema;


class FpaController extends Controller
{
    //

    public function fpa()
    {
        $fpadata = fpa::all();

        return view('admin.fpa', compact('fpadata'));


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


        if ($insert) {

            $activitylog = DB::table('activitylog')->insert([
                'datetime' => now(),
                'editor' => auth()->user()->username,
                'edittedApplication' => 'FPA Record',
                'fieldEditted' => 'All Fields',
                'applicationType' => 'FPA',
                'modificationType' => 'Add',
                'oldValue' => null,
                'newValue' => json_encode([
                    'applicant_name' => $request->applicantname,
                    'applicant_number' => $request->applicantnumber,
                    'reffered_investigator' => $request->refferedinvestigator,
                    'patented_subsisting' => $request->status,
                    'location' => $request->location,
                    'survey_no' => $request->surveynumber,
                    'remarks' => $request->remarks
                ]),
                'applicantName' => $request->applicantname,
            ]);


            return back()->with('success', 'Application added successfully');
        } else {
            return back()->with('error', 'An error ocurrec while updating the record.');
        }
    }


    //     public function updatefpa(Request $request, $id_fpa)
//     {
//         $request->validate([
//             'applicantname' => 'required|string|max:255',
//             'applicantnumber' => 'required|string|max:100',
//             'refferedinvestigator' => 'required|string|max:255',
//             'location' => 'required|string|max:255',
//             'surveynumber' => 'required|string|max:100',
//             'status' => 'required|in:subsisting,patented',
//             'remarks' => 'nullable|string',
//         ]);

    //         $fpa = DB::table('fpa')->where('id_fpa', $id_fpa)->first();
//     $originalData = $fpa;
//         $update = DB::table('fpa')->where('id_fpa', $id_fpa)->update([
//             'applicant_name' => $request->applicantname,
//             'applicant_number' => $request->applicantnumber,
//             'reffered_investigator' => $request->refferedinvestigator,
//             'location' => $request->location,
//             'survey_no' => $request->surveynumber,
//             'patented_subsisting' => $request->status,
//             'remarks' => $request->remarks,
//         ]);
// if($update){
//     $changes = [];
//     foreach ($request->all() as $field => $newValue) {
//         $oldValue = $originalData->$field ?? null;

    //         // Only log if the field has changed
//         if ($oldValue !== $newValue) {
//             $changes[$field] = [
//                 'oldValue' => $oldValue,
//                 'newValue' => $newValue
//             ];
//         }
//     }

    //     if (!empty($changes)) {
//         // Log the changes made to the FPA record
//         $activityLog = DB::table('activitylog')->insert([
//             'datetime' => now(),
//             'editor' => auth()->user()->username,
//             'edittedApplication' => 'FPA Record',
//             'fieldEditted' => $field,
//             'applicationType' => 'FPA',
//             'modificationType' => 'Edit',
//             'oldValue' => $oldValue,
//             'newValue' => $newValue
//         ]);
//     }


    //     return back()->with('success', 'Application updated successfully!');
// }
// else{
//     return back()->with('error', 'An error occurred while updating the record.');
// }

    //     }


    public function updatefpa(Request $request, $id_fpa)
    {
        // Validate incoming data
        $request->validate([
            'applicantname' => 'required|string|max:255',
            'applicantnumber' => 'required|string|max:100',
            'refferedinvestigator' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'surveynumber' => 'required|string|max:100',
            'status' => 'required|in:subsisting,patented',
            'remarks' => 'nullable|string',
        ]);

        // Field mapping
        $fieldMapping = [
            'applicantname' => 'applicant_name',
            'applicantnumber' => 'applicant_number',
            'refferedinvestigator' => 'reffered_investigator',
            'location' => 'location',
            'surveynumber' => 'survey_no',
            'status' => 'patented_subsisting',
            'remarks' => 'remarks',
        ];

        // Fetch the current data for the fpa
        $fpa = DB::table('fpa')->where('id_fpa', $id_fpa)->first();

        // Initialize arrays for tracking changes
        $editedFields = [];
        $oldValues = [];
        $newValues = [];

        // Compare old values with new values
        foreach ($fieldMapping as $formField => $dbColumn) {
            // Normalize case for case-insensitive comparison (especially for status)
            $oldValue = strtolower($fpa->$dbColumn ?? '');  // Old value (convert to lowercase)
            $newValue = strtolower($request->$formField ?? '');  // New value (convert to lowercase)

            // If there is a change in value
            if ($oldValue !== $newValue) {
                $editedFields[] = $dbColumn;
                $oldValues[$dbColumn] = $fpa->$dbColumn;  // Store old value (case-sensitive)
                $newValues[$dbColumn] = $request->$formField;  // Store new value
            }
        }

        // If there are any changes
        if (!empty($editedFields)) {
            // Log the activity
            $logData = [
                'datetime' => now(),
                'editor' => auth()->user()->username,
                'edittedApplication' => $id_fpa,
                'fieldEditted' => implode(', ', $editedFields),
                'applicationType' => 'FPA',
                'modificationType' => 'Edit',
                'oldValue' => json_encode($oldValues),
                'newValue' => json_encode($newValues),
                'applicantName' => $fpa->applicant_name,
            ];

            // Insert the log into the activity log
            DB::table('activitylog')->insert([$logData]);

            // Prepare update data
            $updateData = [];
            foreach ($fieldMapping as $formField => $dbColumn) {
                // Add new value to update data
                $updateData[$dbColumn] = $request->$formField;
            }

            // Update the fpa in the database
            DB::table('fpa')->where('id_fpa', $id_fpa)->update($updateData);

            // Return success message
            return back()->with('success', 'Application updated successfully!');
        } else {
            // Return error if no changes detected
            return back()->with('error', 'No changes detected.');
        }
    }





    public function deletefpa($id_fpa)
    {
        $fpa = DB::table('fpa')->where('id_fpa', $id_fpa)->first();
        // $msa = msa::where($id_msa, 'id_msa')->first();

        // if ($msa) {
        //     $msa->delete();
        //     return back()->with('success', 'Record deleted successfully.');
        // }

        // return back()->with('error', 'Record not found.');

        $deleted = DB::table('fpa')->where('id_fpa', $id_fpa)->delete();

        if ($deleted) {
            $activityLog = DB::table('activitylog')->insert([
                'datetime' => now(),
                'editor' => auth()->user()->username,
                'edittedApplication' => 'FPA Record',
                'fieldEditted' => 'All Fields', // The whole record is deleted
                'applicationType' => 'FPA',
                'modificationType' => 'Delete',
                'oldValue' => json_encode($fpa), // The record data before deletion
                'newValue' => null, // No new value after deletion
                'applicantName' => $fpa->applicant_name,
            ]);
            return back()->with('success', 'Record successfully deleted.');
        } else {
            return back()->with('error', 'Record not found.');
        }

        if ($deleted) {
            return back()->with('success', 'Record successfully deleted.');
        } else {
            return back()->with('error', 'Record not found.');
        }
    }

}


