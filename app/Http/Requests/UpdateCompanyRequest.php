<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', Company::class);
    }

    public function rules(): array
    {
        return [
            'name'      => ['string', 'min:2', 'max:25'],
            'address'   => ['string', 'min:2', 'max:255'],
            'logo'      => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'dimensions:min_width=100,min_height=100'],
            'website'   => ['url'],
        ];
    }
}
