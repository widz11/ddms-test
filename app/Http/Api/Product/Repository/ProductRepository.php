<?php

namespace App\Http\Api\Product\Repository;

use App\Http\Api\Base\Repository\BaseApiRepositoryInterface;
use App\Models\Product;

class ProductRepository implements BaseApiRepositoryInterface
{
    /**
     * Return model
     *
     * @return Class
     */
    public function model() {
        return Product::class;
    }

    /**
     * Return model instance
     *
     * @return Product
     */
    public function modelInstance(): Product {
        return new Product();
    }

    /**
     * @param integer $id
     * @return Product|null
     */
    public function findByID(int $id): ?Product {
        return $this->modelInstance()
            ->query()
            ->where('id', $id)
            ->first();
    }
}
