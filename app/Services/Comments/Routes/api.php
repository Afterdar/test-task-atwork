<?php

declare(strict_types=1);

use App\Services\Comments\Http\Controller\CommentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function (): void {
        Route::prefix('comment')->group(
            function (): void {
                Route::post('/addComment/', [CommentController::class, 'addComment']);
                Route::post('/updateComment/', [CommentController::class, 'updateComment']);
                Route::delete('/deleteComment/', [CommentController::class, 'deleteComment']);

                Route::get('/getListComments/{id}', [CommentController::class, 'getListCommentsCompany']);
                Route::get('/getAverageRatingCompany/{id}', [CommentController::class, 'getAverageRatingCompany']);
                Route::get('/getListTopCompanies', [CommentController::class, 'getListTopCompanies']);
            }
        );
    }
);
