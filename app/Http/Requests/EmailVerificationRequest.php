<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Services\HashIdService;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'bail|required|string',
            'hash' => 'bail|required|string',
        ];
    }

    /**
     * Get the user resolver callback.
     *
     * @return \Closure
     */
    public function getUserResolver()
    {
        return ($this->has('id') && $id = HashIdService::decode($this->id)) ? fn () => User::findOrFail($id) : fn () => null;
    }
}
