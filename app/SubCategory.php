<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = "sub_category";

    public function childs()
    {
        return $this->hasMany('App\SubCategory', 'sub_category_id', 'id');
    }

    public function childrenRecursive()
    {
        return $this->childs()->with('childrenRecursive');
    }

    public static function children($category = null)
    {
        $array = [];
        $sub_categorys = SubCategory::select('id', 'sub_category_name');
        if ($category) {
            $sub_categorys = $sub_categorys->where('category_id', $category);
        }

        $sub_categorys = $sub_categorys->get();
        foreach ($sub_categorys as $sub_category) {
            $array[$sub_category->id] = $sub_category->sub_category_name;
            if (count($sub_category->childs)) {
                $get = SubCategory::childrens($sub_category->childs, $level = 1);
                $array = $array + $get;
            }
        }
        return $array;
    }
    public static function sub_category()
    {
        $array = [];
        $sub_categorys = SubCategory::select('id', 'sub_category_name')
            ->whereNull('category_id')
            ->orWhereNull('sub_category_id')->get();
        foreach ($sub_categorys as $sub_category) {
            $array[$sub_category->id] = $sub_category->sub_category_name;
            if (count($sub_category->childs)) {
                $get = SubCategory::childrens($sub_category->childs, $level = 1);
                $array = $array + $get;
            }
        }
        return $array;
    }
    public static function childrens($sub_categorys, $level)
    {
        foreach ($sub_categorys as $sub_category) {
            $array[$sub_category->id] = str_repeat(" --", $level) . $sub_category->sub_category_name;
            if (count($sub_category->childs)) {
                $get = SubCategory::childrens($sub_category->childs, ++$level);
                $array = $array + $get;
            }
        }
        return $array;
    }
    public function products()
    {
        $products = Products::where('sub_category_id', $this->id)->get();
        return $products;

    }
}
