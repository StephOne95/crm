<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('create', Employee::class);
    }

    public function rules(): array
    {
        return [
            'company_id'    => ['required', 'numeric', 'exists:companies,id'],
            'first_name'    => ['required', 'string', 'min:2', 'max:25'],
            'last_name'     => ['required', 'string', 'min:2', 'max:25'],
            'email'         => ['required', 'email', 'unique:employees,email'],
            'phone'         => ['required', 'numeric'],
        ];
    }
}
