<?php

namespace App\Http\Controllers;

use App\Services\Impl\CategoryServiceImpl;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceImpl $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getRelationshipAll()
    {
        return $this->categoryService->getRelationshipAll();
    }
}
