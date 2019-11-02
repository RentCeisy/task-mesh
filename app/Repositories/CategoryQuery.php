<?php

namespace App\Repositories;

use App\Category;
use App\Repositories\Lib\CategoryRepository;

class CategoryQuery implements CategoryRepository
{

    public function getCategoryById($id): Category
    {
        return Category::findOrFail($id);
    }

    public function getAll()
    {
        return Category::all();
    }

    public function save(Category $category)
    {
        $category->save();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
    }

    public function getRelationshipAll()
    {
        //function roots does not working
        $rootCategories = Category::whereNull('parent_id')->get();
        $categories = [];
        $i = 0;
        foreach ($rootCategories as $category) {
            $childs = $category->children()->get();
            $categories[$i] = [
                'value' => $category->value,
                'id' => $category->id
            ];
            foreach ($childs as $child) {
                $categories[$i]['child'][] = [
                    'value' => $child->value,
                    'id' => $child->id
                ];
            }
            $i++;
        }

        return $categories;
    }
}
