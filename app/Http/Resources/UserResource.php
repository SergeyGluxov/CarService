<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'token' => new TokenResource($this->token),
            'role' => $request->user()->role(),
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_at' => $this->updated_at,
            'tok' => $request->user()->token,
        ];
    }
}
