<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $address
 * @property mixed $website
 * @property mixed $logo
 */
class CompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        $isAdmin = auth()->user() ? auth()->user()->roles->first()->isAdmin() : null;

        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'address'   => $this->when($isAdmin, $this->address),
            'logo'      => asset($this->logo),
            'website'   => $this->when($isAdmin, $this->website),
        ];
    }
}
