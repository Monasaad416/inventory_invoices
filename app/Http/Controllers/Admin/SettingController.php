<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrCreate();
        return view('admin.pages.settings.edit',['settings'=>$settings]);
    }
    public function update(UpdateServiceRequest $request)
    {
        try{
    
            $settings = Setting::first();

            $settings->update([
                'company_name_ar' => $request->company_name_ar,
                'company_name_en' => $request->company_name_en,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'about_ar' => $request->about_ar,
                'about_en' => $request->about_en,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
                'youtube_url' => $request->youtube_url,
            ]);

            if($request->hasFile('logo_footer')) {
                $logoHeadExtension = $request->logo_head->getClientOriginalExtension();
                $logoHeadName = time().'.'.$logoHeadExtension;
                $path = 'uploads/settings';
                $request->logo_head->move($path, $logoHeadName);

                $settings->update([
                    'logo_head' => $logoHeadName,
                ]);
            }

            
            if($request->hasFile('logo_footer')) {
                $logoFooterExtension = $request->logo_footer->getClientOriginalExtension();
                $logoFooterName = time().('_').'.'.$logoFooterExtension;
                $path = 'uploads/settings';
                $request->logo_footer->move($path, $logoFooterName);

                $settings->update([
                    'logo_footer' => $logoFooterName,
                ]);
            }
            if($request->hasFile('testimonial_bg')) {
                $testimonialExtension = $request->testimonial_bg->getClientOriginalExtension();
                $testimonialBg = time().('_1').'.'.$testimonialExtension;
                $path = 'uploads/settings';
                $request->testimonial_bg->move($path, $testimonialBg);

                $settings->update([
                    'testimonial_bg' => $testimonialBg,
                ]);
            }

            if($request->hasFile('footer_bg')) {
                $footerBgExtension = $request->footer_bg->getClientOriginalExtension();
                $footerBg = time().('_2').'.'.$footerBgExtension;
                $path = 'uploads/settings';
                $request->footer_bg->move($path, $footerBg);

                $settings->update([
                    'footer_bg' => $footerBg,
                ]);
            }

             Alert::success(trans('admin.edit_settings_success'));
             return redirect()->route('admin.settings.edit');

        }catch (Exception $e) {
            return redirect()->route('admin.settings.edit')->withErrors(['error' => $e->getMessage()]);
        }


    }
}
