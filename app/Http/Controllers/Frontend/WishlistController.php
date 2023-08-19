<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wishlist()
    {
        return view('frontend.pages.wishlist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wishlistStore(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];

        $wishlist_array = [];

        foreach(Cart::instance('wishlist')->content() as $item) {
            $wishlist_array[] = $item->id;
        }
        if(in_array($product_id, $wishlist_array)) {
            $response['present'] = true;
            $response['message'] = "Item is already in your wishlist";
        }
        else {
            $result = Cart::instance('wishlist')
                ->add($product_id, $product[0]['title'], $product_qty, $price)
                ->associate(Product::class);
            if($result) {
                $response['status'] = true;
                $response['message'] = "Item has been saved in wishlist";
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            }
        }
        return json_encode($response);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function moveToCart(Request $request)
    {
        $item = Cart::instance('wishlist')->get($request->input('rowId'));

        // Cart::instance('wishtlist')->remove($request->input('rowId'));

        $result = Cart::instance('shopping')->add($item->id, $item->name, 1, $item->price)
                    ->associate(Product::class);
        if($result) {
            $response['status'] = true;
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item has been moved to cart";
        }
        if($request->ajax()) {
            $wishlist = view('frontend.layouts._wishlist')->render();
            // $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            // $response['header'] = $header;
        }
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wishlistDelete(Request $request)
    {
        $id = $request->input('rowId');

        Cart::instance('wishlist')->remove($id);

        $response['status'] = true;
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = "Item has been deleted to cart";

        if($request->ajax()) {
            $wishlist = view('frontend.layouts._wishlist')->render();
            $header = view('frontend.layouts.header')->render();
            $response['wishlist_list'] = $wishlist;
            $response['header'] = $header;
        }
        return json_encode($response);
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
