<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        $user = Auth::user();
        return view('frontend.pages.checkout.checkout1', compact('user'));
    }

    public function checkoutOneStore(Request $request)
    {
        Session::put('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'note' => $request->note,
            'sfirst_name' => $request->sfirst_name,
            'slast_name' => $request->slast_name,
            'semail' => $request->semail,
            'sphone' => $request->sphone,
            'saddress' => $request->saddress,
            'scountry' => $request->scountry,
            'scity' => $request->scity,
            'sstate' => $request->sstate,
            'spostcode' => $request->spostcode,
        ]);

        $shippings = Shipping::where('status', 'active')->orderBy('shipping_address', 'ASC')->get();
        return view('frontend.pages.checkout.checkout2', compact('shippings'));
    }

    public function checkoutTwoStore(Request $request)
    {
        Session::push('checkout', [
            'delivery_charge' => $request->delivery_charge,
        ]);

        return view('frontend.pages.checkout.checkout3');
    }

    
    public function checkoutThreeStore(Request $request)
    {
        Session::push('checkout', [
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
        ]);


        return view('frontend.pages.checkout.checkout4');
    }
}
