<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProjectController;
use \App\Http\Controllers\RecordController;
use \App\Http\Controllers\ROIController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\CodesController;

Route::get('/', [FrontendController::class, 'index']);

Route::name('log.')->group(function(){
    Route::post('/login', [AuthenticationController::class, 'login'])->name('in');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('out');
});

Route::middleware(['UserLoggedIn', 'CheckUnsaved'])->group(function () {
    Route::controller(FrontendController::class)->group(function () {
        Route::get('/home/{view}/{ownedPage?}/{readOnlyPage?}', 'home');
        Route::get('/unsaved/{view}', 'unsaved');
        Route::get('/newProject/{projectId?}', 'newProject');
        Route::get('/editProject/{projectId}', 'editProject');
        Route::get('/readOnlyProject/{projectId}', 'readOnlyProject');
        Route::get('/roi/{projectId}', 'showRoi');
        Route::get('/readOnlyRoi/{projectId}', 'readOnlyRoi');
        Route::get('/profile', 'profile');
    });

    Route::controller(ProjectController::class)->group(function () {
        Route::post('/uploadRecords', 'uploadRecords')->name('uploadRecords');
        Route::get('/getTableRecords', 'getTableRecords')->name('getTableRecords');
        Route::get('/deleteProject', 'deleteProject')->name('deleteProject');
    });

    Route::controller(ROIController::class)->group(function () {
        Route::post('/saveRoi', 'saveRoi')->name('saveRoi');
    });

    Route::controller(RecordController::class)->group(function () {
        Route::get('/addRecord', 'addRecord')->name('addRecord');
        Route::get('/editRecord', 'editRecord')->name('editRecord');
        Route::get('/deleteRecord', 'deleteRecord')->name('deleteRecord');

        Route::post('/scoreRecords', 'scoreRecords')->name('scoreRecords');
        Route::get('/getOneRecord', 'getOneRecord')->name('getOneRecord');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('/editProfile', 'editProfile')->name('editProfile');
    });

    Route::controller(CodesController::class)->group(function () {
        Route::get('/getCodes', 'getCodes')->name('getCodes');
    });
});

Route::get('/artisan_commands', function() {
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    return "Cache is cleared";
});

Route::get('/reset_database', function() {
    Artisan::call('optimize');
    Artisan::call('migrate:fresh --seed');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    return "Cache is cleared";
});
