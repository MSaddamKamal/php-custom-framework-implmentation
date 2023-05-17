<?php

namespace App\Models;

class Product extends QueryBuilder
{
    /**
     * @var array
     */
    private array $data;
    /**
     * @var string
     */
    protected static $table = 'products';
    /**
     * @var array|string[]
     */
    protected array $fillables = ['name','sku','price','productType'];

    /**
     * @param $key
     * @return mixed|null
     */
    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return array|string[]
     */
    public function getFillables()
    {
        return $this->fillables;
    }

    /**
     * @return int
     */
    public function save()
    {
        $data = [];

        foreach($this->getFillables() as $val){
            $data[$val] = $this->$val;
        }

       return $this->insert('products',$data);
    }

    /**
     * @return array
     */
    public function getAllProperties()
    {
        return $this->data;
    }
}