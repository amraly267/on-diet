<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\Dashboard\SettingRequest;
use App;
use App\Models\Country;
use App\Models\Timezone;
use Spatie\Permission\Models\Role;

class SettingController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'settings.';
        $this->storageFolder = Setting::storageFolder();
        $this->middleware('permission:setting-edit,admin', ['only' => ['index','update']]);
    }

    // === Change dashbaord language ===
    public function changeLanguage(Request $request)
    {
        if(in_array($request->lang, ['en', 'ar']))
        {
            App::setLocale($request->lang);
            session()->put('dashboard-locale', $request->lang);
        }
        else
        {
            App::setLocale(config('app.fallback_locale'));
            session()->put('dashboard-locale', config('app.fallback_locale'));
        }
        return redirect()->back();
    }
    // === End function ===

    // === Get settings data to form ===
    public function index()
    {
        $settings = Setting::find(1);
        $roles = Role::all();
        $pageTitle = trans(config('dashboard.trans_file').'settings');
        $submitFormRoute = route('admin-update-settings');
        $submitFormMethod = 'put';
        $countries = Country::all();
        $tagifyCountriesValues = $this->retrieveTagifyCountries('id', explode(',', $settings->supported_countries), 'name');
        $tagifyCountriesNames = Country::pluck('name')->all();
        $timezones = Timezone::all();
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('roles', 'timezones','tagifyCountriesNames', 'tagifyCountriesValues', 'countries','settings', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }
    // === End function ===

    // === Update settings ===
    public function update(SettingRequest $request)
    {
        $settingsData = $request->except('logo', 'app_icon', 'favicon', 'white_logo');
        $settings = Setting::find(1);

        if($request->logo_remove)
        {
            $this->removeImage($settings->logo, $this->storageFolder);
            $settingsData['logo'] = null;
        }
        if($request->hasFile('logo'))
        {
            $this->removeImage($settings->logo, $this->storageFolder);
            $settingsData['logo'] = $this->uploadImage($request->logo, $this->storageFolder);
        }

        if($request->app_icon_remove)
        {
            $this->removeImage($settings->app_icon, $this->storageFolder);
            $settingsData['app_icon'] = null;
        }
        if($request->hasFile('app_icon'))
        {
            $this->removeImage($settings->app_icon, $this->storageFolder);
            $settingsData['app_icon'] = $this->uploadImage($request->app_icon, $this->storageFolder);
        }

        if($request->favicon_remove)
        {
            $this->removeImage($settings->favicon, $this->storageFolder);
            $settingsData['favicon'] = null;
        }
        if($request->hasFile('favicon'))
        {
            $this->removeImage($settings->favicon, $this->storageFolder);
            $settingsData['favicon'] = $this->uploadImage($request->favicon, $this->storageFolder);
        }

        if($request->white_logo_remove)
        {
            $this->removeImage($settings->white_logo, $this->storageFolder);
            $settingsData['white_logo'] = null;
        }
        if($request->hasFile('white_logo'))
        {
            $this->removeImage($settings->white_logo, $this->storageFolder);
            $settingsData['white_logo'] = $this->uploadImage($request->white_logo, $this->storageFolder);
        }

        if(!$request->has('city_id'))
        {
            $settingsData['city_id'] = null;
        }

        if(!$request->has('area_id'))
        {
            $settingsData['area_id'] = null;
        }

        $supportedCountries = collect(json_decode($request->supported_countries, true))->map(function($supportedCountry){
            return $supportedCountry['value'];
        });
        $supportedLocales = collect(json_decode($request->supported_locales, true))->map(function($supportedLocale){
            return $supportedLocale['value'];
        })->toArray();

        $settingsData['supported_countries'] = implode(',', Country::whereIn('name->'.config('app.locale'), $supportedCountries)->pluck('id')->all());
        $settingsData['supported_locales'] = implode(',', $supportedLocales);

        $settings->fill($settingsData);
        $settings->save();
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_save')]);
    }
    // === End function ===

    // === Retrieve tagify country values ===
    private function retrieveTagifyCountries($currentColumn, $countries, $retireveCol)
    {
        return Country::whereIn($currentColumn, $countries)->pluck($retireveCol);
    }
    // === End function ===
}
