<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "body" => $this->body,
            "parent_id" => $this->parent_id,
            "status" => $this->status,
            "post_id" => $this->post_id,
            "user" =>new UserResource($this->user),
            'created_at' => $this->created_at,
            'child_comment' => $this->childComments,
        ];
    }
}
