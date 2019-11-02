<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Lib\ProductRepository;

class ProductQuery implements ProductRepository
{

    public function getById($id): Product
    {
        return Product::findOrFail($id);
    }

    public function getCategories($id)
    {
        // TODO: Implement getCategories() method.
    }

    public function save(Product $product)
    {
        $product->save();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function getAll()
    {
        return Product::all();
    }

    public function getProductsByCat(array $ids)
    {
        return Product::whereIn('category_id', $ids)->get();
    }

    public function create(array $data)
    {
        Product::create($data);
    }
}
