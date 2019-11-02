<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lib\ProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @param ProductRepository $productRepository
     * @return void
     */
    public function index(ProductRepository $productRepository)
    {
        return $productRepository->getAll();
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
     * @param ProductRepository $productRepository
     * @return void
     */
    public function store(Request $request, ProductRepository $productRepository)
    {
        $request->validate([
            'id' => 'required|numeric',
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
            Storage::put($path . $imageName, $request->get('image'));
            $image = $path . $imageName;
            $data['image'] = $image;
        }

        $productRepository->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductRepository $productRepository
     * @param int $id
     * @return Product
     */
    public function show(ProductRepository $productRepository, $id)
    {
        return $productRepository->getById($id);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRepository $productRepository, Request $request, $id)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'category' => 'required|numeric',
        ]);
        $product = $productRepository->getById($request->get('id'));
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->category = $request->get('category');
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png|max:1000'
            ]);
            $imageName = $request->file('image')->getClientOriginalName();
            $formatImage = explode('.', $imageName);
            $imageName = time() . '_' . md5($imageName) . '.' . $formatImage[count($formatImage) - 1];
            $path = '/img/';
            Storage::put($path . $imageName, $request->get('image'));
            $image = $path . $imageName;
            $product->image = $image;
        }

        $productRepository->save($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductRepository $productRepository
     * @param int $id
     * @return void
     */
    public function destroy(ProductRepository $productRepository, $id)
    {
        $productRepository->delete($id);
    }
}
