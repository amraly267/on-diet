<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    public $translatable = ['name'];
    protected $fillable = ['name', 'city_id', 'status'];

    // === Area city ===
    public function city()
    {
        return $this->belongsTo(City::class)->withTrashed();
    }
    // === End function ===

    // === Escape translation arabic unicode before saving to DB ===
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    // === End function ===

    // === Status label ===
    public function getStatusLabelAttribute()
    {
        return $this->status ?  "<span class='badge badge-light-success'>".trans(config('dashboard.trans_file').'active')."</span>" : "<span class='badge badge-light-danger'>".trans(config('dashboard.trans_file').'deactivate')."</span>";
    }
    // === End function =
}
