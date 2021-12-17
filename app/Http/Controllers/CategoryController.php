<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Validator;
use Redirect;
class CategoryController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function view()
    {
        $categories = Category::all();
        return view('category.view_category', compact('categories'));

    }
    public function addCategory($id = null)
    {
        $categorys = Category::category();

        $edit = null;
        if ($id) {
            $edit = Category::find($id);
        }
        return view('category.add_category', compact('edit', 'categorys'));
    }
    public function saveCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:category,category_name',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        } else {
            if ($request->id) {
                $category = Category::find($request->id);
                $url = $category->url;
            } else {
                $category = new Category();
            }
            $category->category_name = $request->category_name;
            if ($request->category) {
                $parent_category = Category::find($request->category);
                $category->category_id = $request->category;
                $category->url = $parent_category->url . "/" . $this->URLGenerate($request->category_name);

            }else{
                $category->url = env('APP_URL') . "/" . $this->URLGenerate($request->category_name);
            }
            $category->save();
            if ($request->id) {
                $this->changeAllAssociatedUrl($category, $url);
            }
        }
        return Redirect::route('view-category');
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

    public function changeAllAssociatedUrl($category, $url)
    {
        $sub_category = Category::where('category_id', $category->id)->get();
        foreach ($sub_category as $sub) {
            $sub_url = $sub->url;
            $sub->url = str_replace($url, $category->url, $sub->url);
            $sub->save();
            $this->changeAllAssociatedSubUrl($sub, $sub_url);
            $this->changeAllAssociatedProductUrl($sub, $sub_url);
        }
    }

    public function changeAllAssociatedSubUrl($a, $url)
    {
        $sub_category = Category::where('category_id', $a->id)->get();
        foreach ($sub_category as $sub) {
            $sub_url = $sub->url;
            $sub->url = str_replace($url, $a->url, $sub->url);
            $sub->save();
            $this->changeAllAssociatedSubUrl($sub, $sub_url);
            $this->changeAllAssociatedProductUrl($sub, $sub_url);
        }
    }
    public function changeAllAssociatedProductUrl($a, $url)
    {
        $products = Product::where('category_id', $a->id)->get();
        foreach ($products as $sub) {
            $sub_url = $sub->url;
            $sub->url = str_replace($url, $a->url, $sub->url);
            $sub->save();
        }
    }
}
