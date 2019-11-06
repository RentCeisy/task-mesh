<?php

namespace App\Repositories\Impl;

use App\Product;

interface ProductRepository {
    public function getById($id) :Product;
    public function getAll();
    public function getProductsByCat(array $ids);
    public function save(Product $product);
    public function delete($id);
}
