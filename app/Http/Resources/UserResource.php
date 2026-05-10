<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

/**
 * @mixin User
 */
class UserResource extends JsonApiResource
{
    /**
     * The resource's attributes.
     */
    public array $attributes = [
        'name',
        'email',
        'avatar',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The resource's relationships.
     */
    public array $relationships = [
        //
    ];

    /**
     * Get the resource's meta information.
     */
    public function toMeta(Request $request): array
    {
        return [
            'readable_created_at' => $this->created_at->toDateString(),
        ];
    }
}
