<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionGroup extends Model
{
    use HasFactory;
    protected $table = 'permission_groups';
    protected $fillable = [
        'id','name',
    ];

    public function relatedPerm()
    {
        return $this->hasMany(Permission::class, 'group_id', 'id');
    }

}
