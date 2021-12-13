<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    public static  function subcategories()
    {
        $sub_categories = SubCategory::where('category_id', $this->id)->get();
        return $sub_categories;
    }

    
}
