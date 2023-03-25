<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\CupboardController;
use App\Http\Controllers\DrawerController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DetectiveController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\SaderController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesAndPermissionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\CodeCheckController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\PermissionControlller;
use App\Http\Controllers\ActivtyLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\PostController;

use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/send-email', [EmailController::class, 'sendEmail']);
// Route::post('/contactus', [ContactusController::class, 'contactus']);
Route::post('/password/email', [
	ForgotPasswordController::class,
	'forgot',
])->name('password.email');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('user', UserController::class);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('category', CategoryController::class);
    Route::apiResource('type', TypeController::class);
    Route::apiResource('post', PostController::class);
});
