<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pdf'  => 'required|mimes:pdf'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pdf.required' => __('PDF field is required.'),
            'pdf.mimes'    => __('File type must be PDF.')
        ];
    }



}