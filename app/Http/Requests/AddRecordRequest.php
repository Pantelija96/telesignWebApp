<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRecordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'projectId' => 'required',
            'number' => 'required_without_all:email,ip',
            'email' => 'required_without_all:number,ip',
            'ip' => 'required_without_all:number,email'
        ];
    }

    public function messages()
    {
        return [
            'projectId.required' => 'Some unexpected error occurred!',
            'number.required_without_all' => "Record need to have at least one value! number",
            'email.required_without_all' => "Record need to have at least one value! email",
            'ip.required_without_all' => "Record need to have at least one value! ip",
        ];

    }
}
