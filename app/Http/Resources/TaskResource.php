<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'status'=>$this->status?'done':'pending',
            'deadline'=>$this->deadline,
            'definition_date'=>$this->definition_date,
            'admin'=>$this->admin->name,
            'user'=>$this->user->name,
        ];
    }
}
