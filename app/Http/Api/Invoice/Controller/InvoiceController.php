<?php

namespace App\Http\Api\Invoice\Controller;

use App\Http\Api\Invoice\Repository\InvoiceRepository;
use App\Http\Api\Invoice\Resource\InvoiceResource;
use App\Http\Api\Base\Controller\BaseApiController;
use Illuminate\Support\Str;

class InvoiceController extends BaseApiController
{
    /**
     * Constructor
     *
     * @param InvoiceRepository $invoiceRepository
     * @return void
     */
    public function __construct(
        InvoiceRepository $invoiceRepository
    ) {
        $this->repository = $invoiceRepository;
        $this->resource = InvoiceResource::class;
    }

    /**
     * Return list
     *
     * @return json
     */
    public function list() {
        $isPaginate = request('is_paginate') == 'true' ? true : false;
        $pageSize = request('page_size') ? (int) request('page_size') : 10;
        $startDate = request('start_date');
        $endDate = request('end_date');
        $list = $this->repository->model()::query()
            ->when($startDate, function($query) use($startDate) {
                $startDate = date("Y-m-d", strtotime($startDate));
                return $query->where('created_at', '>=', $startDate);
            })
            ->when($endDate, function($query) use($endDate) {
                $endDate = date("Y-m-d", strtotime($endDate));
                return $query->where('created_at', '<=', $endDate);
            })
            ->latest();
        if($isPaginate) {
            $list = $list->paginate($pageSize);
        } else {
            $list = $list->get();
        }
        return $this->responseJsonResource($this->resource::collection($list));
    }

    /**
     * Create
     *
     * @return json
     */
    public function create() {
        // Validate
        request()->validate([
            'products' => ['required', 'array'],
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer|gt:0',
            'products.*.price' => 'required|numeric|gt:0'
        ]);
        // Create invoice
        $invoice = $this->repository->create(request()->toArray());
        if(! $invoice) {
            return $this->responseJson([], 500, trans('message.failed_save_data'), false);
        }
        return $this->responseJsonResource((new $this->resource($invoice)));
    }
}