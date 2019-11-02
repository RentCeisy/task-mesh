<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\Lib\CategoryRepository;
use App\Repositories\Lib\ProductRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getRelationshipAll();
        $data['title'] = 'Task Mesh group';
//        $pro = Product::all();
        return view('index', $data);
    }
}
