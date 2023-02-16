<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LotlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'date'=> $this->date,
            'category'=> $this->category,
            'lot_title'=> $this->lot_title,
            'lot_location'=> $this->lot_location,
            'lot_condition'=> $this->lot_condition,
            'pre_tax_amount'=> $this->pre_tax_amount,
            'tax_name'=>$this->tax_name,
            'tax_amount'=>$this->tax_amount
        ];
    }
}
