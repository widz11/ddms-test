<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'qty',
        'price',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * @return BelongsToMany
     */
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_product', 'product_id', 'invoice_id')
            ->using(InvoiceProduct::class)
            ->withPivot('quantity', 'price', 'created_at', 'updated_at');
    }
}
