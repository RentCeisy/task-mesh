<?php

namespace App\Repositories;

use App\Category;
use App\Repositories\Lib\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryQuery implements CategoryRepository
{

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategoryById($id): Category
    {
        return $category = $this->category->findOrFail($id);
    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function save($value)
    {
        $this->category->value = $value;
        $this->category->save();
    }

    public function delete($id)
    {
        $this->getCategoryById($id)->delete();
    }

    public function getRelationshipAll()
    {
        //function roots does not working
        $rootCategories = $this->category->whereNull('parent_id')->get();
        foreach ($rootCategories as $category) {
            $categories[] = $category->first()->getDescendantsAndSelf()->toHierarchy();
        }
        $collection = new Collection();
        foreach ($categories as $category) {
            foreach ($category as $item) {
                $collection->push($item);
            }
        }
        return $collection;
    }

    // this function doesn't work correctly becouse baum is dead.
    public function create($value, $parent)
    {
        $this->category->create([
            'value' => $value
        ]);
        if ($parent !== 0) {
            $parentCategory = Category::where('id', $parent)->first();
            $parentCategory->makeSiblingOf($this->category);
        } else {
            $this->category->makeRoot();
        }
    }
}
