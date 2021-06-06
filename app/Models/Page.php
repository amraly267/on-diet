<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'description'];
    protected $fillable = ['title', 'description', 'status', 'is_web', 'is_mobile'];

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

    // === Is web label ===
    public function getIsWebLabelAttribute()
    {
        return $this->is_web ?  "<span class='badge badge-light-success'>".trans(config('dashboard.trans_file').'active')."</span>" : "<span class='badge badge-light-danger'>".trans(config('dashboard.trans_file').'deactivate')."</span>";
    }
    // === End function =

    // === Is mobile label ===
    public function getIsMobileLabelAttribute()
    {
        return $this->is_mobile ?  "<span class='badge badge-light-success'>".trans(config('dashboard.trans_file').'active')."</span>" : "<span class='badge badge-light-danger'>".trans(config('dashboard.trans_file').'deactivate')."</span>";
    }
    // === End function =

}
