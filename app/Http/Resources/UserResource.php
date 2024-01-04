<?php

namespace App\Http\Resources;

use App\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'roles' => $this->roles->map(function(Role $role) {
                return [
                    'id'          => $role->id,
                    'label'       => $role->label,
                    'permissions' => PermissionResource::collection($role->permissions),
                ];
            }),
        ];
    }
}
