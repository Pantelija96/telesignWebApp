<?php

namespace App\Http\Requests;

use App\Exceptions\RecordsFileNotValid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UploadRecordsRequest extends FormRequest
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
            'csvFile' => 'required|file|mimes:xls,xlsx,csv,txt',
            'projectId' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'csvFile.required' => 'Please provide a file for upload!',
            'csvFile.mimes' => 'File needs to be in xls, xlsx, or csv format!',
        ];
    }
}
