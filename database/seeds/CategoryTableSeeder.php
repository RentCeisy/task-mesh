<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 3)->create()->each(function ($category) {
            $category->makeRoot();
            factory(Category::class, 3)->create()->each(function ($catChild) use ($category) {
                $catChild->makeChildOf($category);
            });
        });;
    }
}
