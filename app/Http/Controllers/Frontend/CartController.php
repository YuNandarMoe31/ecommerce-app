<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartStore(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $product_qty = $data['product_qty'];
        $product_id = $data['product_id'];

        // Get product data from the model
        $product = Product::getProductByCart($product_id);

        // Check if the product data is valid
        if ($product !== null && count($product) > 0) {
            // Valid product data is available
            $price = $product[0]['offer_price'];

            // Rest of your code for adding to cart
            $result = Cart::instance('shopping')
                ->add(
                    $product_id,
                    $product[0]['title'],
                    $product_qty,
                    $price
                )
                ->associate(Product::class);

            if ($result) {
                $response['status'] = true;
                $response['product_id'] = $product_id;
                $response['total'] = Cart::subtotal();
                $response['cart_count'] = Cart::instance('shopping')->count();
                $response['message'] = "Item was added to your cart";
            }
        } else {
            $response['status'] = false;
            $response['message'] = "Product not found or has invalid data";
        }

        if ($request->ajax()) {
            $header = view('frontend.layouts.nav')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartDelete(Request $request)
    {
        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);

        $response['status'] = true;
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = "Cart was removed successfully";

        if ($request->ajax()) {
            $header = view('frontend.layouts.nav')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
