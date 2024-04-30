<?php

namespace App\Http\Requests;

use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     */
    public function authorize() : bool
    {
        return $this->user()->can('update', $this->route('user'));
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
   
        return [
            'status' => ['required', 'boolean'],
        ];
    }
}
