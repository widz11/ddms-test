<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InvoiceProduct extends Pivot
{
    protected $table = 'invoice_product';

    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'price',
        'created_at',
        'updated_at',
    ];
}
