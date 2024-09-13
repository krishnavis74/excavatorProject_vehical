<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\UserVehicleController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehiclerepairingController;
use App\Http\Controllers\vehicleRepairingDetailsController;
use App\Http\Controllers\vehicleDocumentcontroller;
use App\Http\Controllers\DocumenttypeController;
use App\Http\Controllers\VehicleWorkplace_Controller;

// use App\Http\Middleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//----------------user@gmail.com-----------------------//
//----------------password-----------------------

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});
/***************************User Vehicle Details  *********************/
//Route::get('add_user_vehicle', [UserVehicleController::class, 'add_user_vehicle']);
Route::post('add_user_vehicle_save', [UserVehicleController::class, 'add_user_vehicle_save']);

// Route::get('user_list', [UserVehicleController::class, 'user_list']);
Route::post('user_list_view', [UserVehicleController::class, 'user_list_view']);
Route::post('user_delete', [UserVehicleController::class, 'user_delete']);

Route::post('user_edit_data', [UserVehicleController::class, 'user_edit_data']);

Route::post('user_update_data', [UserVehicleController::class, 'user_update_data']);

Route::middleware(['auth'])->group(function () {
    Route::get('add_user_vehicle', [UserVehicleController::class, 'add_user_vehicle'])->name('add_user_vehicle');
    Route::get('user_list', [UserVehicleController::class, 'user_list'])->name('user_list');
    Route::get('vehicle_details_list', [VehicleController::class, 'vehicle_details_list'])->name('vehicle_details_list');
    Route::get('add_vehicle', [VehicleController::class, 'add_vehicle'])->name('add_vehicle');

    //////////////////////////////////////backend data///////////////////////////////////////////////////////////////////
    Route::post('dropdown_data', [VehiclerepairingController::class, 'dropdown_data']);

    Route::get('vehicle_repairing_list', [VehiclerepairingController::class, 'vehicle_repairing_list'])->name('vehicle_repairing_list');
    Route::get('add_vehicle_repairing', [VehiclerepairingController::class, 'add_vehicle_repairing'])->name('add_vehicle_repairing');

    Route::get('add_vehicle_document', [vehicleDocumentcontroller::class, 'add_vehicle_document'])->name('add_vehicle_document');
    Route::get('vehicle_document_list', [vehicleDocumentcontroller::class, 'vehicle_document_list'])->name('vehicle_document_list');

    Route::get('add_document_type', [DocumenttypeController::class, 'add_document_type'])->name('add_document_type');
    Route::get('document_type_list', [DocumenttypeController::class, 'document_type_list'])->name('document_type_list');

    Route::get('vehicle_workplace_list', [VehicleWorkplace_Controller::class, 'vehicle_workplace_list'])->name('vehicle_workplace_list');
    Route::get('add_vehicle_workplace', [VehicleWorkplace_Controller::class, 'add_vehicle_workplace'])->name('add_vehicle_workplace');
});

/***************************Vehicle Details  *********************/
// Route::get('vehicle_details_list', [VehicleController::class, 'vehicle_details_list'])->name('vehicle_details_list');
// Route::get('add_vehicle', [VehicleController::class, 'add_vehicle'])->name('add_vehicle');
Route::post('save_vehicle', [VehicleController::class, 'save_vehicle']);
Route::post('show_vehicle_list', [VehicleController::class, 'show_vehicle_list']);
Route::post('edit_vehicle', [VehicleController::class, 'edit_vehicle']);
Route::post('update_vehicle', [VehicleController::class, 'update_vehicle']);
Route::post('delete_vehicle', [VehicleController::class, 'delete_vehicle']);

/***************************Vehicle Repairing Details  *********************/
// Route::get('vehicle_details_list', [VehiclerepairingController::class, 'vehicle_details_list'])->name('vehicle_details_list');

Route::post('save_vehicle_repairing', [VehiclerepairingController::class, 'save_vehicle_repairing']);

Route::post('show_vehicle_repairing_list', [VehiclerepairingController::class, 'show_vehicle_repairing_list']);
Route::post('edit_vehicle_repairing', [VehiclerepairingController::class, 'edit_vehicle_repairing']);
Route::post('update_vehicle_repairing', [VehiclerepairingController::class, 'update_vehicle_repairing']);
Route::post('delete_vehicle_repairing', [VehiclerepairingController::class, 'delete_vehicle_repairing']);

/////////////////////////////vehicle documentType/////////////////////////
Route::post('dropdown_vehicle_document', [vehicleDocumentcontroller::class, 'dropdown_vehicle_document']);
Route::post('dropdown_vehicle_repairing', [vehicleDocumentcontroller::class, 'dropdown_vehicle_repairing']);

Route::post('add_vehicle_document_save', [vehicleDocumentcontroller::class, 'add_vehicle_document_save']);
Route::post('show_vehicle_document_list', [vehicleDocumentcontroller::class, 'show_vehicle_document_list']);
Route::post('edit_vehicle_document', [vehicleDocumentcontroller::class, 'edit_vehicle_document']);
Route::post('update_vehicle_document_data', [vehicleDocumentcontroller::class, 'update_vehicle_document_data']);
Route::post('delete_vehicle_document', [vehicleDocumentcontroller::class, 'delete_vehicle_document']);

/////////////////////////////////////////////documentType///////////////////////////////////////////////
Route::post('add_document_save', [DocumenttypeController::class, 'add_document_save']);
Route::post('show_document_list', [DocumenttypeController::class, 'show_document_list']);
Route::post('edit_document', [DocumenttypeController::class, 'edit_document']);
Route::post('update_document_data', [DocumenttypeController::class, 'update_document_data']);
Route::post('delete_document', [DocumenttypeController::class, 'delete_document']);

/*************************************vehicle workplace **********************/

Route::post('get_vehicle_serial_no', [VehicleWorkplace_Controller::class, 'get_vehicle_serial_no']);
Route::post('get_operator', [VehicleWorkplace_Controller::class, 'get_operator']);
Route::post('save_vehicle_workplace', [VehicleWorkplace_Controller::class, 'save_vehicle_workplace']);
Route::post('get_state', [VehicleWorkplace_Controller::class, 'get_state']);
Route::post('show_vehicle_workplace_list', [VehicleWorkplace_Controller::class, 'show_vehicle_workplace_list']);
Route::post('edit_vehicle_workplace', [VehicleWorkplace_Controller::class, 'edit_vehicle_workplace']);
Route::post('update_vehicle_workplace', [VehicleWorkplace_Controller::class, 'update_vehicle_workplace']);
Route::post('delete_vehicle_workplace', [VehicleWorkplace_Controller::class, 'delete_vehicle_workplace']);

// Route::get('/', function () {
//     return view('auth.loginpage');
// });

// Route::get('/index_page', function () {
//     return view('backend.index');
// });

// Route::get('/vehicle_document', function () {
//     return view('backend.add_vehicle_document');
// });

Route::get('/dashboard', function () {
    return view('backend.index');
})
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__ . '/auth.php';
