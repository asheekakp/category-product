<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Redirect;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function addProduct($id = null)
    {
        $edit = null;
        if ($id) {
            $edit = Product::find($id);
        }
     
        $categorys = Category::category();
        return view('product.add_product', compact('categorys','edit'));
    }

    public function saveProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|unique:product,product_name',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        } else {
            $product = new Product();
            $product->product_name = $request->product;
            $product->category_id = $request->category;
            $category = Category::find($request->category);
            $product->url = $category->url . "/" . $this->URLGenerate($request->product);
            $product->save();
        }

        return Redirect::route('view-product');
  
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
            $p->category = Category::find($p->category_id)->category_name;
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
