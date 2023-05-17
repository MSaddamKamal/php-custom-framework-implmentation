<?php

namespace App\Factory\Product\ProductType;

use App\Models\Product;

class Book extends Product
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
        'weight' => [
            'numeric' => true,
            'required' => true,
        ],

    ];

    /**
     * @return array|string[]
     */
    public function getFillables()
    {
        return $this->fillables =  array_merge(parent::getFillables(),['weight']);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }
}
