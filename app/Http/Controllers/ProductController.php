<?php

namespace App\Http\Controllers;

use App\Repositories\Lib\CategoryRepository;
use App\Repositories\Lib\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductsByCat(ProductRepository $productRepository, CategoryRepository $categoryRepository, int $id)
    {
        if ($id === 0) {
            return [
                'products' => $productRepository->getAll(),
                'path' => storage_path(),
                ];
        }
        $ids = [$id];
        $rootCategory = $categoryRepository->getCategoryById($id);
        $childs = $rootCategory->children()->get();
        foreach ($childs as $child) {
            $ids[] = $child->id;
        }
        return [
        'products' => $productRepository->getProductsByCat($ids),
        'path' => storage_path(),
    ];
    }
}
