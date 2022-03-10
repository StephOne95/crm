<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class CompanyController extends Controller
{
    public function index(): CompanyCollection
    {
        return new CompanyCollection(Company::query()->paginate(5));
    }

    public function store(StoreCompanyRequest $request): CompanyResource
    {
        return new CompanyResource(Company::create($request->validated()));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Company $company): CompanyResource
    {
        $this->authorize('view', $company);

        return new CompanyResource($company);
    }

    public function update(UpdateCompanyRequest $request, Company $company): CompanyResource
    {
        $company->update($request->validated());

        return new CompanyResource($company);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Company $company): ?bool
    {
        $this->authorize('delete', $company);

        return $company->delete();
    }
}
