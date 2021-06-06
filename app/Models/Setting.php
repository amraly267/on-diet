<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Storage;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    public static $storageFolder = 'settings';
    public $translatable = ['project_name'];
    protected $fillable = ['project_name', 'contact_us_email', 'contact_us_mobile', 'contact_us_phone', 'logo', 'facebook_url', 'twitter_url', 'customer_role_id',
                            'app_icon', 'white_logo', 'favicon', 'youtube_url', 'instagram_url', 'whatsapp_number', 'snapchat_url', 'css_in_header',
                            'js_before_header', 'js_before_body', 'supported_countries', 'default_country_id', 'supported_locales', 'default_locale',
                            'timezone_id', 'country_id', 'city_id', 'area_id', 'address', 'mail_from_address', 'mail_from_name', 'mail_host',
                            'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'send_welcome_email'];

    // === Return storage folder to upload or delete model files ===
    protected static function storageFolder()
    {
        return self::$storageFolder;
    }
    // === End function ===

    // === Escape translation arabic unicode before saving to DB ===
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    // === End function ===

    // === Get logo path or set default image ===
    public function getLogoPathAttribute()
    {
        return is_null($this->logo) ? asset('img/dashboard/default-image.svg') : Storage::disk(self::$storageFolder)->url($this->logo);
    }
    // === End function ===

    // === Get white logo path or set default image ===
    public function getWhiteLogoPathAttribute()
    {
        return is_null($this->white_logo) ? asset('img/dashboard/default-image.svg') : Storage::disk(self::$storageFolder)->url($this->white_logo);
    }
    // === End function ===

    // === Get app logo path or set default image ===
    public function getAppIconPathAttribute()
    {
        return is_null($this->app_icon) ? asset('img/dashboard/default-image.svg') : Storage::disk(self::$storageFolder)->url($this->app_icon);
    }
    // === End function ===

    // === Get favicon path or set default image ===
    public function getFaviconPathAttribute()
    {
        return is_null($this->favicon) ? asset('img/dashboard/default-image.svg') : Storage::disk(self::$storageFolder)->url($this->favicon);
    }
    // === End function ===

}
