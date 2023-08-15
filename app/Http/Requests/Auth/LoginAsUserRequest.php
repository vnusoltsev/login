<?php

namespace App\Http\Requests\Auth;

use App\Models\SecretKey;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class LoginAsUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users'],
            'secretKey' => ['required', 'string'],
        ];
    }

    /**
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $secretKey = $validator->getData()['secretKey'];
        $currentUserId = auth()->user()->id;
        $validator->after(
            function ($validator) use ($currentUserId, $secretKey) {
                $hashedSecretKey = SecretKey::query()->where(['user_id' => $currentUserId])->first();
                if (null === $hashedSecretKey) {
                    $validator->errors()->add(
                        'secretKey',
                        'Not found secret key.'
                    );
                    return;
                }
                if (!Hash::check($secretKey, $hashedSecretKey->getAttributeValue('secret_key'))) {
                    $validator->errors()->add(
                        'secretKey',
                        'Secret key is wrong.'
                    );
                }
            }
        );
    }
}
