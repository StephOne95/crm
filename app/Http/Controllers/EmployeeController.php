<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Auth\Access\AuthorizationException;

class EmployeeController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): EmployeeCollection
    {
        $this->authorize('viewAny', Employee::class);

        return new EmployeeCollection(Employee::query()->paginate(5));
    }

    public function store(StoreEmployeeRequest $request): EmployeeResource
    {
        return new EmployeeResource(Employee::create($request->validated()));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Employee $employee): EmployeeResource
    {
        $this->authorize('view', $employee);

        return new EmployeeResource($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Employee $employee): ?bool
    {
        $this->authorize('delete', $employee);

        return $employee->delete();
    }
}
