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
/*            'links'=>[
                'first'=>$this->url(1),
                'last'=>$this->url($this->lastPage()),
                'next'=>$this->currentPage()==$this->lastPage()?null:$this->url($this->currentPage()+1),
                'prev'=>$this->currentPage()==1?null:$this->url($this->currentPage()-1),
            ]*/
        ];
    }
}
