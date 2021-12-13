<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Validator;

class SubCategoryController extends Controller
{
    public function viewSubCategory()
    {
        # code...
    }
    public function addSubCategory($id = null)
    {
        $categories = Category::all();
        return view('category.add_subcategory', compact('categories'));
    }
    public function saveSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_name' => 'required|unique:sub_category,sub_category_name',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        } else {
            $subcategory = new SubCategory();
            $subcategory->sub_category_name = $request->sub_category_name;
            $subcategory->category_id = $request->category;
            $category = Category::find($request->category);
            if ($request->nested) {

            } else {
                $subcategory->url = $category->url . "/" . $this->URLGenerate($request->sub_category_name);
            }
            $subcategory->save();
        }

        $categories = Category::all();
        return view('category.add_subcategory', compact('categories'));
    }
    public function URLGenerate($text)
    {

        // Swap out Non "Letters" with a -
        $text = preg_replace('/[^\\pL\d]+/u', '-', $text);

        // Trim out extra -'s
        $text = trim($text, '-');

        // Convert letters that we have left to the closest ASCII representation
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // Make text lowercase
        $text = strtolower($text);

        // Strip out anything we haven't been able to convert
        $text = preg_replace('/[^-\w]+/', '', $text);

        return $text;

    }
    public function addNestedSubCategory($id = null)
    {
        $categories = Category::all();
        return view('category.add_nested_subcategory', compact('categories'));
    }
    public function saveNestedSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_name' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        } else {
            $subcategory = new SubCategory();
            $subcategory->sub_category_name = $request->sub_category_name;
            $subcategory->sub_category_id = $request->sub_category;
            $category = SubCategory::find($request->sub_category);
            if ($request->nested) {

            } else {
                $subcategory->url = $category->url . "/" . $this->URLGenerate($request->sub_category_name);
            }
            $subcategory->save();
        }

        $categories = Category::all();
        return view('category.add_nested_subcategory', compact('categories'));
    }
    public function getNestedSubCategory(Request $request)
    {
        $category = $request->category; 
        $subcategory = SubCategory::children( $category);
        return view('category.add_subnestedcategory',compact('subcategory','category'));
    }

}
