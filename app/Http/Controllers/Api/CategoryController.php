<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Services\Lib\CategoryServiceImpl;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceImpl $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index() :Collection
    {
        return $this->categoryService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'parent' => 'required|numeric'
        ]);

        $this->categoryService->create($request->get('value'), $request->get('parent'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Category
     */
    public function show($id) :Category
    {
        return $this->categoryService->getCategoryById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);
    }
}
