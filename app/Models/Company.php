<?php

namespace App\Models;

use App\Http\Services\CompanyService;
use Database\Factories\CompanyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $logo
 * @property string $website
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CompanyFactory factory(...$parameters)
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company whereAddress($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereLogo($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @method static Builder|Company whereWebsite($value)
 * @mixin Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'logo',
        'website',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            $companyService = new CompanyService();
            $companyService->onCreating($model);
        });

        static::updating(function($model) {
            $companyService = new CompanyService();
            $companyService->onUpdating($model);
        });
    }
}
