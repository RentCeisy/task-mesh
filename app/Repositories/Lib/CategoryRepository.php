<?php

namespace App\Repositories\Lib;

use App\Category;

interface CategoryRepository
{
    public function getCategoryById($id):Category;
    public function getAll();
    public function getRelationshipAll();
    public function save(Category $category);
    public function delete($id);
}
