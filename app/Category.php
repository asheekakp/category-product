<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    public function childs()
    {
        return $this->hasMany('App\Category', 'category_id', 'id');
    }

    public function childrenRecursive()
    {
        return $this->childs()->with('childrenRecursive');
    }

    public static function children($category = null)
    {
        $array = [];
        $categorys = Category::select('id', 'category_name');
        if ($category) {
            $categorys = $categorys->where('category_id', $category);
        }

        $categorys = $categorys->get();
        foreach ($categorys as $category) {
            $array[$category->id] = $category->category_name;
            if (count($category->childs)) {
                $get = Category::childrens($category->childs, $level = 1);
                $array = $array + $get;
            }
        }
        return $array;
    }
    public static function category()
    {
        $array = [];
        $categorys = Category::select('id', 'category_name')
            ->whereNull('category_id')
            ->orWhereNull('category_id')->get();
        foreach ($categorys as $category) {
            $array[$category->id] = $category->category_name;
            if (count($category->childs)) {
                $get = Category::childrens($category->childs, $level = 1);
                $array = $array + $get;
            }
        }
        return $array;
    }
    public static function childrens($categorys, $level)
    {
        foreach ($categorys as $category) {
            $array[$category->id] = str_repeat(" --", $level) . $category->category_name;
            if (count($category->childs)) {
                $get = Category::childrens($category->childs, ++$level);
                $array = $array + $get;
            }
        }
        return $array;
    }
    public function products()
    {
        $products = Products::where('category_id', $this->id)->get();
        return $products;

    }
    
}
