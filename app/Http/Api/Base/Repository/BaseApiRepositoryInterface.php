<?php

namespace App\Http\Api\Base\Repository;

interface BaseApiRepositoryInterface {
    /**
     * Return model
     *
     * @return Class
     */
    public function model();

    /**
     * Return model instance
     *
     * @return Object
     */
    public function modelInstance();
}