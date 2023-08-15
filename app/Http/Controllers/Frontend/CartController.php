<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        return view('frontend.pages.cart.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cartUpdate(Request $request)
    {
        $this->validate($request, [
            'product_qty' => 'required|numeric',
        ]);
        $rowId = $request->input('rowId');
        $request_quantity = $request->input('product_qty');
        $productQuantity = $request->input('productQuantity');

        if ($request_quantity > $productQuantity) {
            $message = "We currenly do not have enough items in stock";
            $response['status'] = false;
        } elseif ($request_quantity < 1) {
            $message = "You cannot add less than 1 quantity";
            $response['status'] = false;
        } else {
            Cart::instance('shopping')->update($rowId, $request_quantity);
            $message = "Quantity was updated successfully";
            $response['status'] = true;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
        }
        if ($request->ajax()) {
            $header = view('frontend.layouts.nav')->render();
            $cart_list = view('frontend.layouts._cart-list')->render();
            $response['header'] = $header;
            $response['cart_list'] = $cart_list;
            $response['message'] = $message;
        }
        return $response;
    }

    // Coupon
    public function couponAdd(Request $request)
    {
        try {
            $coupon = Coupon::where('code', $request->input('code'))->first();

            if (!$coupon) {
                return back()->with('error', 'Invalid Coupon Code, Please enter valid coupon code');
            }

            $total_price = Cart::instance('shopping')->subtotal();
            $couponValue = $coupon->discount($total_price);

            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $couponValue,
            ]);

            return back()->with('success', 'Coupon applied successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while applying the coupon.');
        }
    }
}
