<?php

namespace App\Factory\Product\ProductType;

use App\Models\Product;

class Furniture extends Product
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
        'height' => [
            'numeric' => true,
            'required' => true,
        ],
        'length' => [
            'numeric' => true,
            'required' => true,
        ],
        'width' => [
            'numeric' => true,
            'required' => true,
        ],

    ];

    /**
     * @return array|string[]
     */
    public function getFillables()
    {
        return $this->fillables =  array_merge(parent::getFillables(),['height','length','width']);
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }
}
