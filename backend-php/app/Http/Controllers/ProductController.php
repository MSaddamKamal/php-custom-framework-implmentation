<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Factory\Product\ProductFactory;
use App\Models\Product;
use App\Utils\Validation;


class ProductController
{
    /**
     * @param Request $request
     * @return mixed|null
     */
    public function index(Request $request)
    {
        $model = new Product();

        $output = [
            'data' => $model->getAll(),
            'error' => false,
            'message' => 'Success',
        ];

        return response()->toJson($output)->setStatusCode(200)->send();

    }

    /**
     * @param Request $request
     * @return mixed|null
     * @throws \Exception
     */
    public function store(Request $request)
    {

       $request->validate([

            'productType' => [
                'required' => true,
                'inArray' => ['DVD', 'Furniture', 'Book']
            ],
        ]);


      if(!$request->hasErrors()){

          $data = $request->all();
          $product =  (new ProductFactory($data['productType']))->getInstance();
          $request->validate($product->getRules());

          if(!$request->hasErrors()){

              $product->sku = $data['sku'] ?? null;
              $product->name = $data['name'] ?? null;
              $product->price = $data['price'] ?? null;
              $product->size = $data['size'] ?? null;
              $product->weight = $data['weight'] ?? null;
              $product->height = $data['height'] ?? null;
              $product->width = $data['width'] ?? null;
              $product->length = $data['length'] ?? null;
              $product->productType = $data['productType'] ?? null;

              $record_id = $product->save();

              $output = [
                'data' => array_merge(['id'=>$record_id],$product->getAllProperties()),
                'error' => false,
                'message' => 'Product Added Successfully',
              ];

              return response()->toJson($output)->setStatusCode(201)->send();
          }


      }

        $output = [
            'data' => Validation::getErrors(),
            'error' => true,
            'message' => 'Something went wrong',
        ];

        return response()->toJson($output)->setStatusCode(422)->send();



    }

    /**
     * @param Request $request
     * @return mixed|null
     */
    public function deleteAll(Request $request)
    {
        Product::deleteAll('id',$request->all()['ids']);

        $model = new Product();

        $output = [
            'data' => $model->getAll(),
            'error' => false,
            'message' => 'Products Deleted Successfully',
        ];

        return response()->toJson($output)->setStatusCode(200)->send();
    }

}