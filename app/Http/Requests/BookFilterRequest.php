<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookFilterRequest extends FormRequest
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

             // ids = comma separated numbers
             'ids'        => ['sometimes', 'regex:/^[0-9]+(,[0-9]+)*$/'],

             // title must be a string
             'title'      => ['sometimes', 'string', 'min:1', 'not_regex:/^\s*$/'],

             // author can be comma separated strings
             'author'     => ['sometimes', 'required', 'string', 'min:1', 'not_regex:/^\s*$/'],

             // languages = comma separated 2 or 3-letter codes like en, fr, arp
             'language'   => ['sometimes', 'regex:/^[a-zA-Z]{2,3}(,[a-zA-Z]{2,3})*$/'],

             // mime types e.g. text/plain, application/pdf
             'mime_type'  => ['sometimes', 'string'],

             // topic = comma separated strings
             'topic'      => ['sometimes', 'string'],

             // pagination page must be integer
             'page'       => ['sometimes', 'integer', 'min:1'],
         ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ids.regex'        => 'ids must be comma-separated numeric values only, like: 1,2,3',
            'title.not_regex'  => 'The title field cannot contain only whitespace.',
            'language.regex'   => 'language must be valid 2 or 3-letter codes like: en,fr,de,enm,ang',
            'page.integer'     => 'page number must be a valid number',
            'page.min'         => 'page must be at least 1',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'The given data was invalid.',
                'errors'  => $validator->errors()
            ], 422)
        );
    }
}
