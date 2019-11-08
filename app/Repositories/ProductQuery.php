<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Impl\ProductRepository;

class ProductQuery implements ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getById($id): Product
    {
        return $this->product->findOrFail($id);
    }

    public function save(Product $product)
    {
        $product->save();
    }

    public function delete($id)
    {
        $product = $this->getById($id);
        $product->delete();
    }

    public function getAll()
    {
        return $this->product->all();
    }

    public function getProductsByCat(array $ids)
    {
        return $this->product->whereIn('category_id', $ids)->get();
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }
}
