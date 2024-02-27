<?php

declare(strict_types=1);

namespace App\Services\Comments\Database\Repository;

use App\Http\Requests\Comment\AddCommentRequest;
use App\Http\Requests\Comment\DeleteCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Services\Comments\Database\Models\Comment;
use Carbon\Carbon;
use Gerfey\Repository\Repository;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository extends Repository
{
    protected $entity = Comment::class;

    public function addComment(AddCommentRequest $addCommentRequest): bool
    {
        return $this->createQueryBuilder()
            ->insert([
                'user_id' => $addCommentRequest['idUser'],
                'company_id' => $addCommentRequest['idCompany'],
                'content' => $addCommentRequest['content'],
                'rating' => $addCommentRequest['rating'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    public function updateComment(UpdateCommentRequest $updateCommentRequest): bool
    {
        $comment = $this->createQueryBuilder()
            ->where('id', '=', $updateCommentRequest['idComment'])
            ->where('user_id', '=', $updateCommentRequest['idUser'])
            ->where('company_id', '=', $updateCommentRequest['idCompany'])
            ->first();

        if ($comment === null)
        {
            return false;
        }

        $comment->fill([
            'user_id' => $updateCommentRequest['idUser'],
            'company_id' => $updateCommentRequest['idCompany'],
            'content' => $updateCommentRequest['content'],
            'rating' => $updateCommentRequest['rating'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return $comment->save();
    }

    public function deleteComment(DeleteCommentRequest $deleteCommentRequest): bool
    {
        $comment = $this->createQueryBuilder()
            ->where('id', '=', $deleteCommentRequest['idComment'])
            ->where('user_id', '=', $deleteCommentRequest['idUser'])
            ->where('company_id', '=', $deleteCommentRequest['idCompany'])
            ->first();

        if ($comment === null)
        {
            return false;
        }

        return $comment->delete();
    }

    public function getListCommentsCompany(int $id): Collection|array
    {
        return $this->createQueryBuilder()
            ->where('company_id', '=', $id)
            ->get();
    }

    public function getAverageRatingCompany(int $id): float|int
    {
        $companiesRating = $this->createQueryBuilder()
            ->where('company_id', '=', $id)
            ->get();

        $arrayRating = [];

        foreach ($companiesRating as $company)
        {
            $arrayRating[] = $company['rating'];
        }

        return array_sum($arrayRating) / count($arrayRating);
    }
}
