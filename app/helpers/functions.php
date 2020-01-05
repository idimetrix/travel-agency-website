<?php

if (!function_exists('get_or_paginate')) {

    /**
     * @OA\Parameter(
     *   description="Enable pagination",
     *   in="query",
     *   name="paginate",
     *   required=false,
     *   @OA\Schema(
     *     type="boolean",
     *     default=true,
     *   ),
     * ),
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return mixed
     */
    function get_or_paginate($builder)
    {
        $paginate = request()->get('paginate');

        if ($paginate === 'false' || $paginate === '0') {
            return $builder->get();
        }

        return $builder->paginate((int)request()->get('per_page', $builder->getModel()->getPerPage()));
    }

}