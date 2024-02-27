<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Requests\BaseRequest;
use Exception;

class AddCompanyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','string', 'min:3', 'max:40'],
            'content' => ['required', 'string', 'min:150', 'max:400'],
            'logo' => ['required', 'file', 'max:3072', 'mimes:png'],
        ];
    }

    /**
     * @throws Exception
     */
    public function messages(): array
    {
        return [
            'name.required' => $this->getMessage('required'),
            'name.string' => $this->getMessage('string'),
            'name.max' => $this->getMessage('max'),
            'name.min' => $this->getMessage('min'),

            'content.required' => $this->getMessage('required'),
            'content.string' => $this->getMessage('string'),
            'content.max' => $this->getMessage('max'),
            'content.min' => $this->getMessage('min'),

            'logo.required' => $this->getMessage('required'),
            'logo.file' => $this->getMessage('file'),
            'logo.max' => $this->getMessage('max'),
            'logo.mimes' => $this->getMessage('mimes'),
        ];
    }
}
