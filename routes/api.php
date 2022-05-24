<?php

require base_path('routes/channels.php');

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CompanyController;

use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', RegisterController::class);
    Route::post('/forgot-password', ForgotPasswordController::class);
    Route::post('/reset-password', ResetPasswordController::class);

    // guest verification (temporary auth)
    // Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
    // Route::post('/verify-resend', [VerificationController::class, 'resend']);
});

Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
Route::post('/verify-resend', [VerificationController::class, 'resend']);

Route::middleware('auth:sanctum')->group(function () {

    Route::patch('/profile', ProfileController::class);
    Route::patch('/password', PasswordController::class);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('offer')->group(function () {

        Route::get('/', [OfferController::class, 'index'])
            ->middleware(['role:company,admin,client'])
            ->middleware(['permission:view-offers']);

        Route::get('/my', [OfferController::class, 'showMyOffers'])
            ->middleware(['role:company,admin'])
            ->middleware(['permission:delete-offers,create-offers,update-offers']);

        Route::get('/show-all-in-city/{id}', [OfferController::class, 'showAllActiveInCity'])
            ->middleware(['role:company,admin,client']);

        Route::get('/{id}', [OfferController::class, 'show'])
            ->where('id', '[0-9]+')
            ->middleware(['role:company,admin,client']);

        Route::post('/', [OfferController::class, 'create'])
            ->middleware(['role:company'])
            ->middleware(['permission:create-offers']);

        Route::put('/{id}', [OfferController::class, 'update'])
            ->where('id', '[0-9]+')
            ->middleware(['role:company,admin'])
            ->middleware(['permission:update-offers']);

        Route::delete('/{id}', [OfferController::class, 'destroy'])
            ->where('id', '[0-9]+')
            ->middleware(['role:company,admin'])
            ->middleware(['permission:delete-offers']);
    });

    Route::prefix('company')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])
            ->middleware(['role:company,admin'])
            ->middleware(['permission:delete-offers,create-offers']);

        Route::get('/{id}', [CompanyController::class, 'show'])
            ->where('id', '[0-9]+')
            ->middleware(['role:company,admin'])
            ->middleware(['permission:delete-offers,create-offers']);

        Route::get('/exists', [CompanyController::class, 'userCompanyExists'])
            ->middleware(['role:company']);

        Route::post('/', [CompanyController::class, 'create'])
            ->middleware(['role:company,admin'])
            ->middleware(['permission:delete-offers,create-offers']);

        Route::put('/{id}', [CompanyController::class, 'update'])
            ->where('id', '[0-9]+')
            ->middleware(['role:company,admin'])
            ->middleware(['permission:delete-offers,create-offers']);

        Route::delete('/{id}', [CompanyController::class, 'destroy'])
            ->where('id', '[0-9]+')
            ->middleware(['role:company,admin'])
            ->middleware(['permission:delete-offers,create-offers']);
    });

    Route::prefix('offers_activation')->group(function () {
        Route::post('/activate', [OffersActivationController::class, 'activate'])
            ->middleware(['role:company,admin']);

        Route::post('/create', [OffersActivationController::class, 'createClientActivationOffer'])
            ->middleware(['role:client']);

        Route::get('/', [OffersActivationController::class, 'getUserOffer'])
            ->middleware(['role:client']);

        Route::get('/cancel', [OffersActivationController::class, 'cancelOwnActivationOffer'])
            ->middleware(['role:client']);
    });

    // in app verification
    // Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
    // Route::post('/verify-resend', [VerificationController::class, 'resend']);
});
Route::get('/user', [UserController::class, 'getUserData']);
Route::get('/user/roles', [UserController::class, 'getUserRoles']);
Route::get('/user/permissions', [UserController::class, 'getUserPermissions']);

Route::get('/routes', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});
