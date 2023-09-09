<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::orderBy('id','DESC')->get();

        return view('backend.seller.index', compact('sellers'));
    }

    public function sellerStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('sellers')->where('id', $request->id)->update([
                'status' => 'active'
            ]);
        } else {
            DB::table('sellers')->where('id', $request->id)->update([
                'status' => 'inactive'
            ]);
        }
        return response()->json(['message' => 'Seller Status updated successfully', 'status' => true]);
    }

    public function sellerVerified(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('sellers')->where('id', $request->id)->update([
                'is_verified' => 1
            ]);
        } else {
            DB::table('sellers')->where('id', $request->id)->update([
                'is_verified' => 0
            ]);
        }
        return response()->json(['message' => 'Seller verified updated successfully', 'status' => true]);
    }
}
