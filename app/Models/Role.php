<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Role admins()
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|Role admin()
 * @method static Builder|Role subscriber()
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    const ROLE_ADMIN        = 'admin';
    const ROLE_SUBSCRIBER   = 'subscriber';

    const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_SUBSCRIBER,
    ];

    public function isAdmin(): bool
    {
        return $this->name === self::ROLE_ADMIN;
    }

    public function isSubscriber(): bool
    {
        return $this->name === self::ROLE_SUBSCRIBER;
    }

    public function scopeAdmin(Builder $query): Builder
    {
        return $query->where('name', self::ROLE_ADMIN);
    }

    public function scopeSubscriber(Builder $query): Builder
    {
        return $query->where('name', self::ROLE_SUBSCRIBER);
    }
}
