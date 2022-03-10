<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\File;

class CompanyService
{
    public function onCreating($model): void
    {
        $movedFile   = $model->logo->move('uploads', $model->logo->getClientOriginalName());
        $model->logo = $movedFile->getPathName();
    }

    public function onUpdating($model)
    {
        $company = $model->getOriginal();

        if(File::exists($company['logo'])) {
            File::delete($company['logo']);
        }

        self::onCreating($model);
    }
}
