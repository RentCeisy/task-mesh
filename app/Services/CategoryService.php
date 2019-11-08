<?php

namespace App\Services;

use App\Category;
use App\Repositories\Impl\CategoryRepository;
use App\Services\Impl\CategoryServiceImpl;
use Illuminate\Database\Eloquent\Collection;

class CategoryService implements CategoryServiceImpl
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryById($id): Category
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function getRelationshipAll()
    {
        return $this->categoryRepository->getRelationshipAll();
    }

    public function save(Category $category)
    {
        $this->categoryRepository->save($category);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function create($value, $parent)
    {
        $this->categoryRepository->create($value, $parent);
    }
}
