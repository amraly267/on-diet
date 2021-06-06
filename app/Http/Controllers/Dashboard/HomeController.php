<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use App\Models\Setting;
use App\Models\Country;
use App\Models\Page;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'home.';
    }

    public function index()
    {
        $totalAdmins = Admin::count();
        $totalRoles = Role::count();
        $totalCountries = Country::count();
        $totalPages = Page::count();
        return view(config('dashboard.resource_folder').$this->controllerResource.'index', compact('totalAdmins', 'totalRoles', 'totalCountries', 'totalPages'));
    }
}
