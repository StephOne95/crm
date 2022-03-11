<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', Employee::class);
    }

    public function rules(): array
    {
        return [
            'first_name'    => ['string', 'min:2', 'max:25'],
            'last_name'     => ['string', 'min:2', 'max:25'],
            'email'         => ['email', 'unique:employees,email'],
            'phone'         => ['numeric'],
        ];
    }
}
