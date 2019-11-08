<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Services\Impl\CategoryServiceImpl;
use App\Services\Impl\ProductServiceImpl;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    protected $productService;
    protected $categoryService;

    public function __construct(ProductServiceImpl $productService, CategoryServiceImpl $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index() :Collection
    {
        return $this->productService->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'category' => 'required|numeric',
        ]);
        $image = null;
        $name = $request->get('name');
        $category = $request->get('category');
        $description = $request->get('description');
        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $category,
        ];
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png|max:1000'
            ]);
            $imageName = $request->file('image')->getClientOriginalName();
            $formatImage = explode('.', $imageName);
            $imageName = time() . '_' . md5($imageName) . '.' . $formatImage[count($formatImage) - 1];
            $path = '/img/';
            Storage::putFileAs($path, $request->get('image'), $imageName);
            $image = $path . $imageName;
            $data['image'] = $image;
        }

        if ($this->productService->create($data)) {
            return response(['created' => true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Product
     */
    public function show($id)
    {
        return $this->productService->getById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'category' => 'required|numeric',
        ]);
        $product = $this->productService->getById($id);
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->category_id = $request->get('category');
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png|max:1000'
            ]);
            $imageName = $request->file('image')->getClientOriginalName();
            $formatImage = explode('.', $imageName);
            $imageName = time() . '_' . md5($imageName) . '.' . $formatImage[count($formatImage) - 1];
            $path = '/img/';
            Storage::putFileAs($path, $request->file('image'), $imageName);
            $image = $path . $imageName;
            $product->image = $image;
        }

        $this->productService->save($product);
        return ['updated' => true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return ['deleted' => true];
    }

    public function getProductsByCat(int $id)
    {
        if ($id === 0) {
            return $this->productService->index();
        }
        $ids[] = $id;
        $rootCategory = $this->categoryService->getCategoryById($id);
        $childs = $rootCategory->children()->get();
        foreach ($childs as $child) {
            $ids[] = $child->id;
        }
        return $this->productService->getProductsByCat($ids);
    }
}
