<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use App\Http\Requests\BaseRequest;
use Exception;

class UpdateCompanyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','min:3', 'max:50'],
            'content' => ['required','min:15', 'max:400'],
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
            'name.max' => $this->getMessage('max'),
            'name.min' => $this->getMessage('min'),

            'content.required' => $this->getMessage('required'),
            'content.max' => $this->getMessage('max'),
            'content.min' => $this->getMessage('min'),

            'logo.required' => $this->getMessage('required'),
            'logo.file' => $this->getMessage('file'),
            'logo.max' => $this->getMessage('max'),
            'logo.mimes' => $this->getMessage('mimes'),
        ];
    }
}
