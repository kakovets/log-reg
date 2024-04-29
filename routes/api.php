<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PilotAuthController;
use App\Http\Controllers\PilotAccountController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\EditController;

Route::prefix('/countries')
    ->name('countries.')
    ->controller(GlobalController::class)
    ->group(function () {

        Route::get('/', 'getCountries')->name('countries');

        Route::get('/{id}', 'getCountry')->name('country');

        Route::get('/{id}/circuits', 'getCircuits')
            ->middleware('auth:api')
            ->name('circuits');
    });

Route::prefix('/auth')->name('auth.')->controller(PilotAuthController::class)->group(function () {

    Route::post('/register', 'register')->name('register');

    Route::post('/login', 'login')->name('login');

    Route::post('/logout', 'logout')->middleware('auth:api')->name('logout');
});

Route::prefix('/account')
    ->name('account.')
    ->middleware('auth:api')
    ->controller(PilotAccountController::class)
    ->group(function () {

        Route::get('/me', 'getCurrentPilot')->name('me');

        Route::get('/circuits', 'getPilotCircuits')->name('circuits');

        Route::delete('/delete', 'deletePilot')->name('delete');
    });

Route::prefix('/edit')
    ->name('edit.')
    ->middleware('auth:api')
    ->controller(EditController::class)
    ->group(function () {

        Route::prefix('/add')->name('add.')->group(function () {
            Route::put('/country', 'addCountry')->name('country');
            Route::put('/circuit', 'addCircuit')->name('circuit');
        });

        Route::prefix('/patch')->name('patch.')->group(function () {
            Route::patch('/country', 'patchCountry')->name('country');
            Route::patch('/circuit', 'patchCircuit')->name('circuit');
        });

        Route::prefix('/delete')->name('delete.')->group(function () {
            Route::delete('/country', 'deleteCountry')->name('country');
            Route::delete('/circuit', 'deleteCircuit')->name('circuit');
        });
    });
