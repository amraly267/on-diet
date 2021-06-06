<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Country extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    public static $storageFolder = 'countries';
    public $translatable = ['name'];
    protected $fillable = ['name', 'name_code', 'phone_code', 'flag', 'status'];

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

    // === Get flag path or set default image ===
    public function getFlagPathAttribute()
    {
        return is_null($this->flag) ? asset('img/dashboard/default-flag.svg') : Storage::disk(self::$storageFolder)->url($this->flag);
    }
    // === End function ===

    // === Status label ===
    public function getStatusLabelAttribute()
    {
        return $this->status ?  "<span class='badge badge-light-success'>".trans(config('dashboard.trans_file').'active')."</span>" : "<span class='badge badge-light-danger'>".trans(config('dashboard.trans_file').'deactivate')."</span>";
    }
    // === End function =
}
