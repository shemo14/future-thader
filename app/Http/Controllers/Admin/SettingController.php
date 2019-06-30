<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppSetting;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index() {
        $setting = AppSetting::all();
        $socials = Social::all();
        return view('dashboard.settings.index', [
            'setting'  => $setting,
            'socials'  => $socials,
        ]);
    }

    public function updateSiteInfo(Request $request) {

        $rules =[
            'site_name' => 'required'
        ];
        $messages = [
            'site_name.required' => 'اسم التطبيق مطلوب'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        if ($request->has('site_logo')) {

            $image = $request->file('site_logo');
            $name = 'logo.png';
            $path = public_path('/images/site');
            $image->move($path, $name);
        }


        $siteName = AppSetting::where('key', 'site_name')->first();
        $siteName->value = $request->site_name;
        $siteName->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'بتحديث بيانات التطبيق', $ip);
        Session::flash('success', 'تم تعديل بيانات التطبيق');
        return back();
    }

    public function storeSocial(Request $request) {
        $rules = [
            'site_name' => 'required|min:2|max:190',
            'icon'      => 'required|min:2|max:190',
            'url'       => 'required|url',
        ];
        $messages = [
            'site_name.required'    => 'اسم الموقع مطلوب',
            'site_name.min'         => 'اسم الموقع لابد ان يكون اكتر من حرفين',
            'site_name.max'         => 'اسم الموقع لابد ان يكون اقل من 190 حرف',
            'icon.required'         => 'الشعار مطلوب',
            'icon.min'              => 'الشعار لابد ان يكون اكبر من حرفين',
            'icon.max'              => 'الشعار لابد ان يكون اقل من 190 حرف',
            'url.required'          => 'الرابط مطلوب',
            'url.url'               => 'الرابط غير صحبح',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $social = new Social();
        $social->site_name = $request->site_name;
        $social->icon = $request->icon;
        $social->url = $request->url;
        $social->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'باضافة موقع تواصل جدبد', $ip);
        Session::flash('success', 'تم اضافة الموقع');
        return back();
    }

    public function updateSocial(Request $request) {
        $rules = [
            'edit_name' => 'required|min:2|max:190',
            'edit_icon'      => 'required|min:2|max:190',
            'edit_url'       => 'required|url',
            'id'        => 'required',
        ];
        $messages = [
            'edit_name.required'    => 'اسم الموقع مطلوب',
            'edit_name.min'         => 'اسم الموقع لابد ان يكون اكتر من حرفين',
            'edit_name.max'         => 'اسم الموقع لابد ان يكون اقل من 190 حرف',
            'edit_icon.required'         => 'الشعار مطلوب',
            'edit_icon.min'              => 'الشعار لابد ان يكون اكبر من حرفين',
            'edit_icon.max'              => 'الشعار لابد ان يكون اقل من 190 حرف',
            'edit_url.required'          => 'الرابط مطلوب',
            'edit_url.url'               => 'الرابط غير صحبح',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $social = Social::findOrFail($request->id);
        $social->site_name = $request->edit_name;
        $social->icon = $request->edit_icon;
        $social->url = $request->edit_url;
        $social->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'بتحديث موقع تواصل', $ip);
        Session::flash('success', 'تم تحديث الموقع');
        return back();
    }

    public function deleteSocial($id, Request $request) {
        Social::where('id', $id)->delete();

        $ip = $request->ip();
        addReport(auth()->user()->id, 'بحذف موقع تواصل', $ip);
        Session::flash('success', 'تم حذف الموقع');
        return back();
    }
}
