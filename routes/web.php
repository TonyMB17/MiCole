<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ExceptionController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\InstitutionController;

// Route::get('', [IndexController::class, 'actionIndex'])->middleware('GenericMiddleware:index/index');
Route::get('', [WaterController::class, 'actionInsert'])->middleware('GenericMiddleware:water/insert');

Route::get('index/indexadmin/{year?}/{month?}', [IndexController::class, 'actionIndexAdmin'])->middleware('GenericMiddleware:index/indexadmin');
Route::post('index/indexadmin', [IndexController::class, 'actionIndexAdmin'])->middleware('GenericMiddleware:index/indexadmin');

Route::get('general/privacy', [GeneralController::class, 'actionPrivacy'])->middleware('GenericMiddleware:general/privacy');
Route::get('general/accesserror', [GeneralController::class, 'actionAccessError'])->middleware('GenericMiddleware:general/accesserror');
Route::get('general/backup', [GeneralController::class, 'actionBackup'])->middleware('GenericMiddleware:general/backup');
Route::post('general/search', [GeneralController::class, 'actionSearch'])->middleware('GenericMiddleware:general/search');

Route::post('user/login', [UserController::class, 'actionLogIn'])->middleware('GenericMiddleware:user/login');
Route::match(['get', 'post'], 'user/loginasadmin', [UserController::class, 'actionLogInAsAdmin'])->middleware('GenericMiddleware:user/loginasadmin');
Route::get('user/logout', [UserController::class, 'actionLogOut'])->middleware('GenericMiddleware:user/logout');
Route::match(['get', 'post'], 'user/recoverypassword', [UserController::class, 'actionRecoveryPassword'])->middleware('GenericMiddleware:user/recoverypassword');
Route::post('user/getrecoverycode', [UserController::class, 'actionGetRecoveryCode'])->middleware('GenericMiddleware:user/getrecoverycode');
Route::post('user/changeemail', [UserController::class, 'actionChangeEmail'])->middleware('GenericMiddleware:user/changeemail');
Route::post('user/getemailchangecode', [UserController::class, 'actionGetEmailChangeCode'])->middleware('GenericMiddleware:user/getemailchangecode');
Route::post('user/insert', [UserController::class, 'actionInsert'])->middleware('GenericMiddleware:user/insert');
Route::match(['get', 'post'], 'user/insertasadmin', [UserController::class, 'actionInsertAsAdmin'])->middleware('GenericMiddleware:user/insertasadmin');
Route::get('user/thanksregister/{confirmation?}', [UserController::class, 'actionThanksRegister'])->middleware('GenericMiddleware:user/thanksregister');
Route::get('user/registerconfirmation/{email}/{confirmCode?}', [UserController::class, 'actionRegisterConfirmation'])->middleware('GenericMiddleware:user/registerconfirmation');
Route::match(['get', 'post'], 'user/edit', [UserController::class, 'actionEdit'])->middleware('GenericMiddleware:user/edit');
Route::match(['get', 'post'], 'user/editasadmin/{idUser?}', [UserController::class, 'actionEditAsAdmin'])->middleware('GenericMiddleware:user/editasadmin');
Route::post('user/uploadavatar', [UserController::class, 'actionUploadAvatar'])->middleware('GenericMiddleware:user/uploadavatar');
Route::post('user/changepassword', [UserController::class, 'actionChangePassword'])->middleware('GenericMiddleware:user/changepassword');
Route::get('user/getall/{currentPage}', [UserController::class, 'actionGetAll'])->middleware('GenericMiddleware:user/getall');
Route::get('user/deleteinactive', [UserController::class, 'actionDeleteInactive'])->middleware('GenericMiddleware:user/deleteinactive');
Route::post('user/filterbyfirstnamesurnameemail', [UserController::class, 'actionFilterByFirstNameSurNameEmail'])->middleware('GenericMiddleware:user/filterbyfirstnamesurnameemail');

Route::get('usernotification/read/{idUserNotification}', [UserNotificationController::class, 'actionRead'])->middleware('GenericMiddleware:usernotification/read');
Route::post('usernotification/readall', [UserNotificationController::class, 'actionReadAll'])->middleware('GenericMiddleware:usernotification/readall');
Route::post('usernotification/seebyscroll', [UserNotificationController::class, 'actionSeeByScroll'])->middleware('GenericMiddleware:usernotification/seebyscroll');
Route::post('usernotification/verify', [UserNotificationController::class, 'actionVerify'])->middleware('GenericMiddleware:usernotification/verify');

Route::match(['get', 'post'], 'configuration/management', [ConfigurationController::class, 'actionManagement'])->middleware('GenericMiddleware:configuration/management');

Route::get('exception/getall', [ExceptionController::class, 'actionGetAll'])->middleware('GenericMiddleware:exception/getall');
Route::get('exception/changestatus/{idException}/{status}', [ExceptionController::class, 'actionChangeStatus'])->middleware('GenericMiddleware:exception/changestatus');

Route::match(['get', 'post'], 'water/insert', [WaterController::class, 'actionInsert'])->middleware('GenericMiddleware:water/insert');
Route::get('water/getall/{currentPage}', [WaterController::class, 'actionGetAll'])->middleware('GenericMiddleware:water/getall');
Route::get('water/export', [WaterController::class, 'actionExport'])->middleware('GenericMiddleware:water/export');

Route::post('district/chgtoinsertwater', [DistrictController::class, 'actionChgToInsertWater'])->middleware('GenericMiddleware:district/chgtoinsertwater');

Route::get('institution/getall/{currentPage}', [InstitutionController::class, 'actionGetAll'])->middleware('GenericMiddleware:institution/getall');
Route::post('institution/usermanagement', [InstitutionController::class, 'actionUserManagement'])->middleware('GenericMiddleware:institution/usermanagement');
Route::post('institution/chgtoinsertwater', [InstitutionController::class, 'actionChgToInsertWater'])->middleware('GenericMiddleware:institution/chgtoinsertwater');
?>