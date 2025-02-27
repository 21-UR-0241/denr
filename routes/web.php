<?php

use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MsaController;
use App\Http\Controllers\TsaController;
use App\Http\Controllers\SaController;
use App\Http\Controllers\RfpaController;
use App\Http\Controllers\FpaController;
use App\Http\Controllers\SpController;
use App\Http\Controllers\AccountsController;

use App\Http\Controllers\SuperAdminTSAController;
use App\Http\Controllers\SuperAdminSPController;
use App\Http\Controllers\SuperAdminSAController;
use App\Http\Controllers\SuperAdminRFPAController;
use App\Http\Controllers\SuperAdminFPAController;
use App\Http\Controllers\SuperAdminMSAController;
// Protect the dashboard route with auth middleware



Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('admin.index');  // Ensure you have a view for this page
    })->name('admin.index');

    Route::get('/user-login', [UserController::class, 'userlogin'])->name('login');
    Route::post('/login-user', [UserController::class, 'loginUser'])->name('authenticate');

});
Route::post('/logout-user', [UserController::class, 'logoutUser'])->name('logout');
Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'login'])->name('admin.dashboard');
    Route::get('/account', [AccountsController::class, 'manageAccount'])->name('account');
    Route::post('/createAccount', [AccountsController::class, 'createAccount'])->name('createAccount');

    //MSA
    Route::get('/msa', [MsaController::class, 'msa'])->name('msa');
    Route::post('/addmsa', [MsaController::class, 'addmsa'])->name('addmsa');
    Route::delete('/delete/{id_msa}', [MsaController::class, 'delete'])->name('deletemsa');
    Route::put('/update/{id_msa}', [MsaController::class, 'update'])->name('updatemsa');

    //SA
    Route::get('/sa', [SaController::class, 'sa'])->name('sa');
    Route::post('/addsa', [SaController::class, 'addsa'])->name('addsa');
    Route::delete('/deletesa/{id_sa}', [SaController::class, 'deletesa'])->name('deletesa');
    Route::put('/updatesa/{id_sa}', [SaController::class, 'updatesa'])->name('updatesa');

    //RFPA
    Route::get('/rfpa', [RfpaController::class, 'rfpa'])->name('rfpa');
    Route::post('/addrfpa', [RfpaController::class, 'addrfpa'])->name('addrfpa');
    Route::put('/updaterfpa/{id_rfpa}', [RfpaController::class, 'updaterfpa'])->name('updaterfpa');
    Route::delete('/deleterfpa/{id_rfpa}', [RfpaController::class, 'deleterfpa'])->name('deleterfpa');

    //FPA
    Route::get('/fpa', [FpaController::class, 'fpa'])->name('fpa');
    Route::post('/addfpa', [FpaController::class, 'addfpa'])->name('addfpa');
    Route::put('/updatefpa/{id_fpa}', [FpaController::class, 'updatefpa'])->name('updatefpa');
    Route::delete('/deletefpa/{id_fpa}', [FpaController::class, 'deletefpa'])->name('deletefpa');

    //TSA
    Route::get('/tsa', [TsaController::class, 'tsa'])->name('tsa');
    Route::post('/addtsa', [TsaController::class, 'addtsa'])->name('addtsa');
    Route::put('/updatetsa/{id_tsa}', [TsaController::class, 'updatetsa'])->name('updatetsa');
    Route::delete('/deletetsa/{id_tsa}', [TsaController::class, 'deletetsa'])->name('deletetsa');

    //SP
    Route::get('/sp', [SpController::class, 'sp'])->name('sp');
    Route::post('/addsp', [SpController::class, 'addsp'])->name('addsp');
    Route::put('/updatesp/{id_sp}', [SpController::class, 'updatesp'])->name('updatesp');
    Route::delete('/deletesp/{id_sp}', [SpController::class, 'deletesp'])->name('deletesp');
});


Route::middleware(['check.superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [UserController::class, 'sadashboard'])->name('sadashboard');
    Route::get('/account', [AccountsController::class, 'manageAccount'])->name('account');
    Route::post('/createAccount', [AccountsController::class, 'createAccount'])->name('createAccount');

    //MSA
    Route::get('/superadmin/msa', [SuperAdminMSAController::class, 'msa'])->name('superadmin.msa');
    Route::post('/superadmin/addmsa', [SuperAdminMSAController::class, 'addmsa'])->name('superadmin.addmsa');
    Route::delete('/superadmin/delete/{id_msa}', [SuperAdminMSAController::class, 'delete'])->name('superadmin.deletemsa');
    Route::put('/superadmin/update/{id_msa}', [SuperAdminMSAController::class, 'update'])->name('superadmin.updatemsa');

    //SA
    Route::get('/superadmin/sa', [SuperAdminSAController::class, 'sa'])->name('superadmin.sa');
    Route::post('/superadmin/addsa', [SuperAdminSAController::class, 'addsa'])->name('superadmin.addsa');
    Route::delete('/superadmin/deletesa/{id_sa}', [SuperAdminSAController::class, 'deletesa'])->name('superadmin.deletesa');
    Route::put('/superadmin/updatesa/{id_sa}', [SuperAdminSAController::class, 'updatesa'])->name('superadmin.updatesa');

    //RFPA
    Route::get('/superadmin/rfpa', [SuperAdminRFPAController::class, 'rfpa'])->name('superadmin.rfpa');
    Route::post('/superadmin/addrfpa', [SuperAdminRFPAController::class, 'addrfpa'])->name('superadmin.addrfpa');
    Route::put('/superadmin/updaterfpa/{id_rfpa}', [SuperAdminRFPAController::class, 'updaterfpa'])->name('superadmin.updaterfpa');
    Route::delete('/superadmin/deleterfpa/{id_rfpa}', [SuperAdminRFPAController::class, 'deleterfpa'])->name('superadmin.deleterfpa');

    //FPA
    Route::get('/superadmin/fpa', [SuperAdminFPAController::class, 'fpa'])->name('superadmin.fpa');
    Route::post('/superadmin/addfpa', [SuperAdminFPAController::class, 'addfpa'])->name('superadmin.addfpa');
    Route::put('/superadmin/updatefpa/{id_fpa}', [SuperAdminFPAController::class, 'updatefpa'])->name('superadmin.updatefpa');
    Route::delete('/superadmin/deletefpa/{id_fpa}', [SuperAdminFPAController::class, 'deletefpa'])->name('superadmin.deletefpa');

    //TSA
    Route::get('/superadmin/tsa', [SuperAdminTSAController::class, 'tsa'])->name('superadmin.tsa');
    Route::post('/superadmin/addtsa', [SuperAdminTSAController::class, 'addtsa'])->name('superadmin.addtsa');
    Route::put('/superadmin/updatetsa/{id_tsa}', [SuperAdminTSAController::class, 'updatetsa'])->name('superadmin.updatetsa');
    Route::delete('/superadmin/deletetsa/{id_tsa}', [SuperAdminTSAController::class, 'deletetsa'])->name('superadmin.deletetsa');

    //SP
    Route::get('/superadmin/sp', [SuperAdminSPController::class, 'sp'])->name('superadmin.sp');
    Route::post('/superadmin/addsp', [SuperAdminSPController::class, 'addsp'])->name('superadmin.addsp');
    Route::put('/superadmin/updatesp/{id_sp}', [SuperAdminSPController::class, 'updatesp'])->name('superadmin.updatesp');
    Route::delete('/superadmin/deletesp/{id_sp}', [SuperAdminSPController::class, 'deletesp'])->name('superadmin.deletesp');

    Route::get('/superadmin/activity-log', [ActivityLogController::class, 'showActivityLog'])->name('superadmin.activityLog');
});




