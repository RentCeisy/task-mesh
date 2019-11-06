<?php

namespace App\Http\Controllers;

use App\Services\Impl\CategoryServiceImpl;
use App\Services\Impl\ProductServiceImpl;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductServiceImpl $productService, CategoryServiceImpl $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function getProductsByCat(int $id)
    {
        if ($id === 0) {
            return $this->productService->index();
        }
        $ids = [$id];
        $rootCategory = $this->categoryService->getCategoryById($id);
        $childs = $rootCategory->children()->get();
        foreach ($childs as $child) {
            $ids[] = $child->id;
        }
        return $this->productService->getProductsByCat($ids);
    }
}
