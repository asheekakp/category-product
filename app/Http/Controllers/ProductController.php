<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function addProduct()
    {
        $categories = Category::all();        
        return view('product.add_product', compact('categories'));
    }

    public function saveProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|unique:product,product_name',
            'sub_category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        } else {
            $product = new Product();
            $product->product_name = $request->product;
            $product->sub_category_id = $request->sub_category;
            $category = SubCategory::find($request->sub_category);
            $product->url = $category->url . "/" . $this->URLGenerate($request->product);
            $product->save();
        }

        $categories = Category::all();        
        return view('product.add_product', compact('categories'));
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
    public function view()
    {
        $product = Product::all();
        foreach ($product as $p) {
            $p->sub_category = SubCategory::find($p->sub_category_id)->sub_category_name;
        }
        return view('product.view_product', compact('product'));

    }

public function nestedSubProduct(Request $request)
    {
        $category = $request->category; 
        $subcategory = SubCategory::children( $category);
        return view('product.add_subnestedcategory',compact('subcategory','category'));
    }
}
