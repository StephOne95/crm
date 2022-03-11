<?php

namespace App\Http\Services;

use App\Models\Company;
use Illuminate\Http\UploadedFile;

class CompanyFactoryService
{
    public function companyFactory($width, $height): array
    {
        return Company::factory()->create([
            'logo' =>  UploadedFile::fake()->image('test.png', $width, $height),
        ])->toArray();
    }

}
