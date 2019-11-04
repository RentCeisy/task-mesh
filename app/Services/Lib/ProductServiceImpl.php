<?php

namespace App\Services\Lib;

use App\Product;

interface ProductServiceImpl
{
    public function index();
    public function getById($id);
    public function create(array $data);
    public function save(Product $product);
    public function delete($id);
    public function getProductsByCat(array $ids);
}
