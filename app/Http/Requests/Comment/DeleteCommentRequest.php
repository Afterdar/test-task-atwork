<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseRequest;

use Exception;

class DeleteCommentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'idCompany' => ['required','int'],
            'idUser' => ['required','int'],
            'idComment' => ['required','int'],
        ];
    }

    /**
     * @throws Exception
     */
    public function messages(): array
    {
        return [
            'idCompany.required' => $this->getMessage('required'),
            'idCompany.int' => $this->getMessage('int'),

            'idUser.required' => $this->getMessage('required'),
            'idUser.int' => $this->getMessage('int'),

            'idComment.required' => $this->getMessage('required'),
            'idComment.int' => $this->getMessage('int'),
        ];
    }
}
