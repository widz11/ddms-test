<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    protected $fillable = [
        'trx_id',
        'amount_total',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_product', 'invoice_id', 'product_id')
            ->using(InvoiceProduct::class)
            ->withPivot('quantity', 'price', 'created_at', 'updated_at');
    }
}
