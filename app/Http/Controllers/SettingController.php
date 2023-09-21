<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        $setting = Setting::first();
        return view('backend.setting.setting', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settingUpdate(Request $request)
    {
        $setting = Setting::first();
        $status = $setting->update([
            'title' => $request->title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'favicon' => $request->favicon,
            'logo' => $request->logo,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'footer' => $request->footer,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'pinterest_url' => $request->pinterest_url,
        ]);
        if($status) {
            return back()->with('success', 'Setting updated successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function smtp()
    {
        return view('backend.setting.smtp');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smtpUpdate(Request $request)
    {
        foreach($request->types as $key=>$type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }
        return back()->with('success', 'SMTP configuration updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if(file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"',$type.'='.$val,file_get_contents($path)
                ));
            } else {
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
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
