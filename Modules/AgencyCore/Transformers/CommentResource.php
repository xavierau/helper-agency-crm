<?php

namespace Modules\AgencyCore\Transformers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'         => $this->id,
            'content'    => $this->content,
            'created_at' => $this->created_at,
            'author'     => new UserResource($this->author),
        ];
    }
}
