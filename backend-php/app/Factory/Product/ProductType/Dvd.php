<?php

namespace App\Factory\Product\ProductType;

use App\Models\Product;

class Dvd extends Product
{
    /**
     * @var array
     */
    private array $rules = [
        'sku' => [
            'unique' => 'products',
            'required' => true,
        ],
        'name' => [
            'regular_expression' => '/^[a-zA-z ]+$/',
            'required' => true,
        ],
        'price' => [
            'numeric' => true,
            'required' => true,
        ],
        'size' => [
            'numeric' => true,
            'required' => true,
        ],

    ];

    /**
     * @return array|string[]
     */
    public function getFillables()
    {
        return $this->fillables =  array_merge(parent::getFillables(),['size']);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }
}
