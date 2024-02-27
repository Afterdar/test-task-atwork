<?php

declare(strict_types=1);

use App\Services\Company\Http\Controller\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function (): void {
        Route::prefix('company')->group(
            function (): void {
                Route::post('/addCompany', [CompanyController::class, 'addCompany']);
                Route::post('/updateCompany/{id}', [CompanyController::class, 'updateCompany']);
                Route::delete('/deleteCompany/{id}', [CompanyController::class, 'deleteCompany']);
            }
        );
    }
);

