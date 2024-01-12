<?php

namespace App\Http\Api\Invoice\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'trx_id' => $this->trx_id,
            'amount_total' => $this->amount_total,
            'created_at' => $this->created_at,
            'products' => $this->products,
        ];
    }
}