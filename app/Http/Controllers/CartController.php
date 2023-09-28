<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function get()
    {
        return view('site.pages.cart');
    }

    public function addItem(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $attributes = $request->except('_token', 'product_id', 'unit_price', 'qty');

        if ($request->input('qty') > $product->qty || $request->input('unit_price') < $product->unit_price && $request->input('unit_price') < $product->sale_price) {
            return back()->with('add_to_cart_error', 'Product quantity or price are not valid');
        }

        \Cart::session(auth()->id())->add(
            array(
                'id' => uniqid(),
                'name' => $product->name,
                'price' => intval($request->input('unit_price')),
                'quantity' => $request->input('qty'),
                'attributes' => $attributes,
                'model_id' => $request->input('product_id'),
                'associatedModel' => $product
            )
        );

        return back()->with('added_to_cart', 'Item added to cart successfully');
    }
}
