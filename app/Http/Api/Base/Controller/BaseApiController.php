<?php

namespace App\Http\Api\Base\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

abstract class BaseApiController extends Controller
{
    protected $repository;
    protected $resource;

    /**
     * Return response
     *
     * @param JsonResource $jsonResource
     * @param integer $httpCode
     * @param string $message
     * @param boolean $status
     * @return JsonResource
     */
    protected function responseJsonResource(JsonResource $jsonResource, $httpCode = 200, $message = 'Success', $status = true) 
    {   
        $meta = [
            'current_page' => '',
            'from' => '',
            'last_page' => '',
            'path' => '',
            'per_page' => '',
            'to' => '',
            'total' => ''
        ];

        $links = [
            'first' => '',
            'last' => '',
            'prev' => '',
            'next' => ''
        ];

        if(is_null($jsonResource->resource)) {
            $data = [];
            $meta = [];
            $links = [];
        } else {    
            $data = $jsonResource;
            $meta = Arr::only($jsonResource->resource->toArray(), array_keys($meta));
            $links = Arr::only($jsonResource->resource->toArray(), ['first_page_url', 'last_page_url', 'prev_page_url', 'next_page_url']);
        }

        $result = array(
            'status' => $status,
            'message' => $message,
            'http_code' => $httpCode,
            'data' => $data,
            'links' => (object) $links,
            'meta' => (object) $meta
        );

        return response($result, $httpCode);
    }

    /**
     * Return response
     *
     * @param array $data
     * @param integer $httpCode
     * @param string $message
     * @param boolean $status
     * @return JsonResource
     */
    protected function responseJson($data = [], $httpCode = 200, $message = 'Success', $status = true) 
    {   
        $result = array(
            'status' => $status,
            'message' => $message,
            'http_code' => $httpCode,
            'data' => $data
        );

        return response($result, $httpCode);
    }
}
