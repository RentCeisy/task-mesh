<?php

namespace App\Http\Controllers;

use App\Repositories\Lib\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getRelationshipAll(CategoryRepository $categoryRepository)
    {
        return $categoryRepository->getRelationshipAll();
    }
}
