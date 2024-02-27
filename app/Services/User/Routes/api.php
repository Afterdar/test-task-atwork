<?php

declare(strict_types=1);

use App\Services\User\Http\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function (): void {
        Route::prefix('user')->group(
            function (): void {
                Route::post('/addUser', [UserController::class, 'addUser']);
                Route::post('/updateUser/{id}', [UserController::class, 'updateUser']);
                Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);
            }
        );
    }
);

