<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'products' => $this->whenLoaded('products', fn () => $this->getProductsRelation())
        ];
    }
//  check
    /**
     * Get the products relation and set into an array.
     *
     * @return array
     */

     private function getProductsRelation(): array
     {
         $products = ProductResource::collection($this->products()->paginate(6)->appends(request()->query()))
             ->response()
             ->getData(true);
         return  [
             'data' => $products['data'],
             'pages' => ['links' => $products['links'], 'meta' => $products['meta']]
         ];
     }
}
