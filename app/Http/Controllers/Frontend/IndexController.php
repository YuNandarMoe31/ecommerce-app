<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->limit('3')->orderBy('id', 'DESC')->get();
        $new_products = Product::where(['status' => 'active', 'condition' => 'new'])->limit('8')->orderBy('id', 'DESC')->get();
        $featured_products = Product::where(['status' => 'active', 'is_featured' => 1])->limit('6')->orderBy('id', 'DESC')->get();

        return view('frontend.index', compact(['banners', 'categories', 'new_products', 'featured_products']));
    }

    public function shop(Request $request)
    {
        $products = Product::query();

        // category filter
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();

            $products = $products->whereIn('cat_id', $cat_ids);
        }

        // brand filter
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();

            $products = $products->whereIn('brand_id', $brand_ids);
        }

        // size filter
        if (!empty($_GET['size'])) {
            $sizes = is_array($_GET['size']) ? $_GET['size'] : explode(',', $_GET['size']);
            $size = $products->whereIn('size', $sizes);
        }

        // sorting
        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'ASC');
            }
            if ($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'DESC');
            }
            if ($_GET['sortBy'] == 'discAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'ASC');
            }
            if ($_GET['sortBy'] == 'discDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'DESC');
            }
            if ($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'ASC');
            }
            if ($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'DESC');
            }
        }

        // price range filter
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            // Convert the extracted price values to floats
            $price[0] = floatval($price[0]);
            $price[1] = floatval($price[1]);

            // Apply floor and ceil functions to the price values
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);

            $products = $products->whereBetween('offer_price', $price)->where('status', 'active')->paginate(12);
        } else {
            $products = $products->where('status', 'active')->paginate(12);
        }

        $brands = Brand::where('status', 'active')->orderBy('title', 'ASC')->with('products')->get();

        $cats = Category::where([
            'status' => 'active',
            'is_parent' => 1
        ])->with('products')
            ->orderBy('title', 'ASC')->get();

        return view('frontend.pages.product.shop', compact(['products', 'cats', 'brands']));
    }

    public function shopFilter(Request $request)
    {
        $data = $request->all();

        // Category Filter
        $catUrl = '';
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }

        // Sort Filter
        $sortByUrl = '';
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy=' . $data['sortBy'];
        }

        // Price Filter
        $priceUrl = '';

        if (!empty($data['price_range'])) {
            $encodedPriceRange = str_replace(' ', '%24', $data['price_range']);
            $priceUrl .= '&price=' . $encodedPriceRange;
        }

        // Brand Filter
        $brandUrl = '';

        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }

        // Size Filter
        $sizeUrl = '';

        if (!empty($data['size'])) {
            $sizeUrl .= '&size=' . $data['size'];
        }

        return redirect()->route('shop', $catUrl . $sortByUrl . $priceUrl . $brandUrl . $sizeUrl);
    }

    public function autosearch(Request $request)
    {
        $query = $request->get('term', '');
        $products = Product::where('title', 'LIKE', '%' . $query . '%')->get();

        $data = array();

        foreach ($products as $product) {
            $data[] = array(
                'value' => $product->title,
                'id' => $product->id
            );
            if (count($data)) {
                return $data;
            } else {
                return [
                    'value' => "No Result Found",
                    'id' => ''
                ];
            }
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('title', 'LIKE', '%' . $query . '%')->orderBy('id', 'DESC')->paginate(12);
        $brands = Brand::where('status', 'active')->orderBy('title', 'ASC')->with('products')->get();

        $cats = Category::where([
            'status' => 'active',
            'is_parent' => 1
        ])->with('products')
            ->orderBy('title', 'ASC')->get();

        return view('frontend.pages.product.shop', compact('products', 'cats', 'brands'));
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

        if ($request->sort != null) {
            $sort = $request->sort;
        }

        if ($categories == null) {
            return view('errors.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->paginate(12);
            } elseif ($sort == 'priceDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->paginate(12);
            } elseif ($sort == 'discAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->paginate(12);
            } elseif ($sort == 'discDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'DESC')->paginate(12);
            } elseif ($sort == 'titleAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->paginate(12);
            } elseif ($sort == 'titleDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->paginate(12);
            } else {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->paginate(12);
            }
        }

        $route = 'product-category';

        if ($request->ajax()) {
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
        Session::put('url.intended', URL::previous());
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
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     session(['user' => Auth::user()->role]);

        //     // You can redirect the user to their appropriate dashboard based on their role
        //     if (Auth::user()->role === 'admin') {
        //         return redirect()->route('home')->with('success', 'Login Successful');
        //     } elseif (Auth::user()->role === 'user') {
        //         return redirect()->route('home')->with('success', 'Login Successful');
        //     } elseif (Auth::user()->role === 'vendor') {
        //         return redirect()->route('home')->with('success', 'Login Successful');
        //     }

        //     // If none of the specified roles match, you can handle it here
        //     return back()->with('error', 'Invalid email and password'); // Or any other default route
        // }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            Session::put('user', $request->email);

            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'))->with('success', 'Login Successfully');
            } else {
                return redirect()->route('home')->with('success', 'Login Successfully');
            }
        } else {
            return back()->with('error', 'Invalid email and password');
        }
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

    public function userDashboard()
    {
        $user = Auth::user();
        return view('frontend.user.dashboard', compact('user'));
    }

    public function userOrder()
    {
        $user = Auth::user();
        return view('frontend.user.order', compact('user'));
    }

    public function userAddress()
    {
        $user = Auth::user();
        return view('frontend.user.address', compact('user'));
    }

    public function userAccount()
    {
        $user = Auth::user();
        return view('frontend.user.account', compact('user'));
    }

    public function billingAddress(Request $request, $id)
    {
        $user = User::where('id', $id)->update([
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state,
        ]);

        if ($user) {
            return back()->with('success', 'Address successfully updated');
        } else {
            return back()->with('error', 'something went wrong');
        }
    }

    public function shippingAddress(Request $request, $id)
    {
        $user = User::where('id', $id)->update([
            'saddress' => $request->saddress,
            'scountry' => $request->scountry,
            'scity' => $request->scity,
            'spostcode' => $request->spostcode,
            'sstate' => $request->sstate,
        ]);

        if ($user) {
            return back()->with('success', 'Shipping Address successfully updated');
        } else {
            return back()->with('error', 'something went wrong');
        }
    }

    public function updateAccount(Request $request, $id)
    {
        $this->validate($request, [
            'newPass' => 'nullable|min:3',
            'currentPass' => 'nullable|min:3',
            'full_name' => 'required|string',
            'username' => 'nullable|string',
            'phone' => 'nullable',
        ]);
        $hashpassword = Auth::user()->password;

        if ($request->currentPass == null && $request->newPass == null) {
            User::where('id', $id)->update([
                'full_name' => $request->full_name,
                'username' => $request->username,
                'phone' => $request->phone,
            ]);
            return back()->with('success', 'Account updated successfully');
        } else {
            if (Hash::check($request->currentPass, $hashpassword)) {
                if (!Hash::check($request->newPass, $hashpassword)) {
                    User::where('id', $id)->update([
                        'full_name' => $request->full_name,
                        'username' => $request->username,
                        'phone' => $request->phone,
                        'password' => Hash::make($request->newPass),
                    ]);
                    return back()->with('success', 'Account updated successfully');
                } else {
                    return back()->with('error', 'New password cannot be same with old password');
                }
            } else {
                return back()->with('error', 'Old password does not match');
            }
        }
    }
}
