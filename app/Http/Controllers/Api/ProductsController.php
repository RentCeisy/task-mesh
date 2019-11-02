<?php

namespace App\Http\Controllers\Api;

use App\Product;
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
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png|max:1000'
            ]);
            $imageName = $request->file('image')->getClientOriginalName();
            $formatImage = explode('.', $imageName);
            $imageName = time() . '_' . md5($imageName) . '.' . $formatImage[count($formatImage) - 1];
            $path = 'img/';
            $publicPath = public_path($path);
            Storage::put($path . $imageName, $request->get('image'));
            $image = $imageName;
        }
        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $category,
            'image' => $image,
        ];
        $productRepository->create($data);

        return [
            'msg' => 'update Success'
        ];
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
    public function update(Request $request, $id)
    {
        //
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
