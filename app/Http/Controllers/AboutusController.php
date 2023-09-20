<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function aboutUs()
    {
        $about = AboutUs::first();
        return view('backend.about.index', compact('about'));
    }

    public function aboutUpdate(Request $request)
    {
        $about = AboutUs::first();
        $status = $about->update([
            'heading' => $request->heading,
            'content' => $request->input('content'),
            'experience' => $request->experience,
            'happy_customer' => $request->happy_customer,
            'team_advisor' => $request->team_advisor,
            'return_customer' => $request->return_customer,
            'image' => $request->image
        ]);

        if ($status) {
            return redirect()->back()->with('success', 'About Us updated successfully');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
