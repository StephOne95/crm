<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('create', Company::class);
    }

    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'min:2', 'max:25'],
            'address'   => ['required', 'string', 'min:2', 'max:255'],
            'logo'      => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'dimensions:min_width=100,min_height=100'],
            'website'   => ['required', 'url'],
        ];
    }
}
