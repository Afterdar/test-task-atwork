<?php

declare(strict_types=1);

namespace App\Services\Comments\Http\Controller;

use App\Http\Requests\Comment\AddCommentRequest;
use App\Http\Requests\Comment\DeleteCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Services\Comments\Database\Repository\CommentRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class CommentController extends BaseController
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function addComment(AddCommentRequest $addCommentRequest): JsonResponse
    {
        $addComment = $this->commentRepository->addComment($addCommentRequest);

        if ($addComment === false) {
            throw new Exception('Ошибка создания комментария');
        }

        return ResponseBuilder::success(['Комментарий создан']);
    }

    public function updateComment(UpdateCommentRequest $updateCommentRequest): JsonResponse
    {
        $updateComment = $this->commentRepository->updateComment($updateCommentRequest);

        if ($updateComment === false){
            throw new Exception('Ошибка обновления комментария, неверный id');
        }

        return ResponseBuilder::success(['Комментарий обновлен']);
    }

    public function deleteComment(DeleteCommentRequest $deleteCommentRequest): JsonResponse
    {
        $deleteComment = $this->commentRepository->deleteComment($deleteCommentRequest);

        if ($deleteComment === false) {
            throw new Exception('Произошла ошибка удаления комментария, неверный id');
        }

        return ResponseBuilder::success(['Комментарий удален']);
    }
}
