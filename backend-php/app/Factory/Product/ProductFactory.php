<?php

namespace App\Factory\Product;

class ProductFactory
{
    /**
     * @var string
     */
    private $product_type;

    /**
     * @param $type
     */
    public function __construct($type)
    {
        $this->product_type = ucfirst(strtolower($type));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getInstance()
    {
        $class = "App\\Factory\\Product\\ProductType\\". $this->product_type;
        try{
            return new $class;
        }
        catch (\Exception $e){
            throw new \Exception('Invalid Product Type Provided');
        }
    }
}
