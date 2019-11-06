<?php

namespace App\Services\Impl;

use App\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceImpl
{
    public function getCategoryById($id) :Category;
    public function getAll() :Collection;
    public function getRelationshipAll();
    public function create($value, $parent);
    public function save(Category $category);
    public function delete($id);
}
