<?php

namespace App\Http\Api\Invoice\Repository;

use App\Http\Api\Base\Repository\BaseApiRepositoryInterface;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceRepository implements BaseApiRepositoryInterface
{
    /**
     * Return model
     *
     * @return Class
     */
    public function model() {
        return Invoice::class;
    }

    /**
     * Return model instance
     *
     * @return Invoice
     */
    public function modelInstance(): Invoice {
        return new Invoice();
    }

    /**
     * Create data
     *
     * @param $data
     * @return User
     */
    public function create($data = []) {
        // Init
        $result = null;
        $total = 0;
        $invoiceProducts = is_array($data['products']) ? $data['products'] : [];

        if(is_array($data)) {
            try {
                DB::beginTransaction();

                // Calculate product
                foreach ($invoiceProducts as $invoiceProduct) {
                    $product = Product::query()
                        ->where('id', $invoiceProduct["product_id"])
                        ->first();
                    if (!$product || $product->quantity < $invoiceProduct["quantity"]) {
                        continue;
                    }
                    $total = $total + ($invoiceProduct["quantity"] * $invoiceProduct["price"]);
                    $product->quantity = $product->quantity - $invoiceProduct["quantity"];
                    $product->save();
                }

                // Init invoice
                $invoice = $this->model()::query()
                    ->create([
                        'trx_id' => Str::uuid()->toString(),
                        'amount_total' => $total,
                    ]);
                $invoice->products()->attach($invoiceProducts);
                $result = $invoice;
                
                DB::commit();
            } catch(\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }

        return $result;
    }
}
