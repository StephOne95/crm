<?php

namespace App\Models;

use App\Http\Services\CompanyService;
use Database\Factories\CompanyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;

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
 * @property-read Collection|Employee[] $employees
 * @property-read int|null $employees_count
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

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public static function boot() {
        parent::boot();

        if (Request::isMethod('post')) {
            static::creating(function ($model) {
                $companyService = new CompanyService();
                $companyService->onCreating($model);
            });
        }

        static::updating(function($model) {
            $companyService = new CompanyService();
            $companyService->onUpdating($model);
        });
    }
}
