<?php

namespace App\Modules\Homeowner\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeownerUploadRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:csv']
        ];
    }

}
