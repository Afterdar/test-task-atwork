<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseRequest;

use Exception;

class UpdateCommentRequest extends BaseRequest
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
            'content' => ['required', 'min:15', 'max:550'],
            'rating' => ['required', 'int', 'min:1', 'max:10'],
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

            'content.required' => $this->getMessage('required'),
            'content.min' => $this->getMessage('min'),
            'content.max' => $this->getMessage('max'),

            'rating.required' => $this->getMessage('required'),
            'rating.int' => $this->getMessage('int'),
            'rating.min' => $this->getMessage('min'),
            'rating.max' => $this->getMessage('max'),
        ];
    }
}
