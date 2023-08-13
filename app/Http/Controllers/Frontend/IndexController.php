<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id', 'DESC')->limit('5')->get();
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->limit(3)->orderBy('id', 'DESC')->get();

        return view('frontend.index', compact(['banners', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with(['products'])->where('slug', $slug)->first();

        $sort = '';

        if($request->sort != null) {
            $sort = $request->sort;
        }

        if($categories == null) {
            return view('errors.404');
        } else {
            if($sort == 'priceAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->paginate(12);
            } 
            elseif($sort == 'priceDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->paginate(12);
            }
            elseif($sort == 'discAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->paginate(12);
            }
            elseif($sort == 'discDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'DESC')->paginate(12);
            }
            elseif($sort == 'titleAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->paginate(12);
            }
            elseif($sort == 'titleDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->paginate(12);
            } 
            else {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->paginate(12);
            }
        }

        $route = 'product-category';

        if($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact('products'))->render();
            return response()->json(['html' => $view]);
        }

        return view('frontend.pages.product.product-category', compact(['categories', 'route', 'products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productDetail($slug)
    {
        $product = Product::with('rel_prods')->where('slug', $slug)->first();
        if ($product) {
            return view('frontend.pages.product.product-detail', compact('product'));
        } else {
            return 'Product detail not found';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userAuth()
    {
        return view('frontend.auth.auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['user' => Auth::user()->role]);

            // You can redirect the user to their appropriate dashboard based on their role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('home')->with('success', 'Login Successful');
            } elseif (Auth::user()->role === 'user') {
                return redirect()->route('home')->with('success', 'Login Successful');
            } elseif (Auth::user()->role === 'vendor') {
                return redirect()->route('home')->with('success', 'Login Successful');
            }

            // If none of the specified roles match, you can handle it here
            return back()->with('error', 'Invalid email and password'); // Or any other default route
        }
        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
        //    Session::put('user', $request->email);

        //     if(Session::get('url.intended')) {
        //         return Redirect::to(Session::get('url.intended'));
        //     } else {
        //         return redirect()->route('home')->with('success', 'Login Successfully');
        //     }
        // } else {
        //     return back()->with('error', 'Invalid email and password');
        // }
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
        //     $user = Auth::user();
        //     if ($user->hasRole('admin')) {
        //         return redirect()->route('home');
        //     } elseif ($user->hasRole('user')) {
        //         return redirect()->route('home');
        //     }
        // } else {
        //     return back()->with('error', 'Invalid email and password');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function registerSubmit(Request $request)
    {
        $this->validate($request, [
            'username' => 'nullable|string',
            'full_name' => 'required|string',
            'email' => 'email|required|unique:users,email',
            'password' => 'min:3|required'
        ]);
        // $data = $request->all();
        $check = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($check) {
            return redirect()->route('home')->with('success', 'Register Successfully');;
        } else {
            return back()->with('error', 'Please check your credentials');
        }
    }

    // private function create(array $data) 
    // {
    //     return User::create([
    //         'full_name' => $data['full_name'],
    //         'username' => $data['username'],
    //         'email' => $data['email'],
    //         'password' => $data['password'],
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();

        return redirect()->route('home')->with('success', 'Logout successfully');
    }
}
