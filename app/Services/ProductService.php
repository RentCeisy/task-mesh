<?php

namespace App\Services;

use App\Product;
use App\Repositories\Impl\ProductRepository;
use App\Services\Impl\ProductServiceImpl;

class ProductService implements ProductServiceImpl
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->productRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function save(Product $product)
    {
        $this->productRepository->save($product);
    }

    public function delete($id)
    {
        $this->productRepository->delete($id);
    }

    public function getProductsByCat(array $ids)
    {
        return $this->productRepository->getProductsByCat($ids);
    }
}
