<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Exception;

class AddUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'surname' => ['required', 'string','min:3', 'max:40'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['required', 'string', 'min:12', 'max:12', 'regex:((\+7)+([0-9]){10})'],
            'avatar' => ['required', 'file', 'max:2048', 'mimes:jpeg,png,jpg'],
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

            'surname.required' => $this->getMessage('required'),
            'surname.string' => $this->getMessage('string'),
            'surname.max' => $this->getMessage('max'),
            'surname.min' => $this->getMessage('min'),

            'password.required' => $this->getMessage('required'),
            'password.string' => $this->getMessage('string'),
            'password.min' => $this->getMessage('min'),

            'phone.required' => $this->getMessage('required'),
            'phone.string' => $this->getMessage('string'),
            'phone.min' => $this->getMessage('min'),
            'phone.max' => $this->getMessage('max'),
            'phone.regex' => $this->getMessage('regex'),

            'avatar.required' => $this->getMessage('required'),
            'avatar.file' => $this->getMessage('file'),
            'avatar.max' => $this->getMessage('max'),
            'avatar.mimes' => $this->getMessage('mimes'),
        ];
    }
}
