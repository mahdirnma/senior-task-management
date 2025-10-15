<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tasks'=>$this->collection,
            'meta'=>[
                'total'=>$this->total(),
                'current_page'=>$this->currentPage(),
                'per_page'=>$this->perPage(),
                'first_page'=>1,
                'last_page'=>$this->lastPage(),
                'from'=>$this->firstItem(),
                'to'=>$this->lastItem(),
            ],
        ];
    }
}
