<?php

namespace App\Repositories\Lib;

use App\Category;

interface CategoryRepository
{
    public function getCategoryById($id):Category;
    public function getAll();
    public function create($value, $parent);
    public function getRelationshipAll();
    public function save($value);
    public function delete($id);
}
