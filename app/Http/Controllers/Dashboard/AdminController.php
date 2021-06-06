<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Dashboard\AdminRequest;
use Spatie\Permission\Models\Permission;
use App\Models\Country;
use PDF;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'admins.';
        $this->storageFolder = Admin::storageFolder();
        $this->middleware('permission:admin-list,admin', ['only' => ['index','show']]);
        $this->middleware('permission:admin-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:admin-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:admin-delete,admin', ['only' => ['destroy']]);
    }

    public function downloadPdf(Request $request)
    {
        return response()->json(['path' => route('admins.index', ['download-pdf' => true, 'request' => $request->all()])]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $countries = Country::all();
        $roles = Role::all();
        $totalResults = Admin::count();

        if($request->has('download-pdf'))
        {
            $request = new Request($request->all()['request']);
            $filter = $this->datatableFilter($request);
            $admins = $filter['admins'];
            $visibleColsNames = $request->visibleColsNames;
            $colsIndexName = $request->colsIndexName;
            $html = view(config('dashboard.resource_folder').$this->controllerResource.'pdf', compact('admins', 'visibleColsNames', 'colsIndexName'))->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->download(trans(config('dashboard.trans_file').'admins').'.pdf');
        }

        if($request->ajax())
        {
            $filterData = $this->datatableFilter($request);
            $response = ["draw" => intval($filterData['draw']),
                            "iTotalRecords" => $totalResults,
                            "iTotalDisplayRecords" => $filterData['totalRecordswithFilter'],
                            "aaData" => $filterData['admins']];

            echo json_encode($response);
        }
        else
        {
            return view(config('dashboard.resource_folder').$this->controllerResource.'index', compact('totalResults', 'countries', 'roles'));
        }
    }

    // === Datatable filter parameters ===
    private function datatableFilter($request)
    {
        // === Get data table request values ===
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowsPerPage = $request->get("length");
        $columnIndexValues = $request->get('order');
        $columnNames = $request->get('columns');
        $orderValues = $request->get('order');

        $columnIndex = $columnIndexValues[0]['column']; // Column index
        $columnName = $columnNames[$columnIndex]['data']; // Column name
        $columnSortOrder = $orderValues[0]['dir']; // asc or desc

        $model = (new Admin)->newQuery();

        if($request->filled('search_keyword'))
        {
            $model->where(function($q) use ($request){
                $q->where('name', 'like', '%'.$request->search_keyword.'%')
                ->orWhere('email', 'like', '%'.$request->search_keyword.'%')
                ->orWhere('mobile', 'like', '%'.$request->search_keyword.'%');
            });
        }

        if($request->filled('gender'))
        {
            $model->where('gender', $request->gender);
        }
        if($request->filled('country_id'))
        {
            $model->where('country_id', $request->country_id);
        }
        if($request->filled('role'))
        {
            $model->whereHas('roles', function($q) use ($request){$q->where('name', $request->role);});
        }

        // === Filter records if there is search keyword ===
        $totalRecordswithFilter = $model->count();

        // === Fetch records ===
        $excludeOrderColumnFromSql = ['country', 'role'];
        if(!in_array($columnName, $excludeOrderColumnFromSql))
        {
            $model->orderBy($columnName,$columnSortOrder);
        }

        $adminRecords = $model->skip($start)->take($rowsPerPage)->get();

        $admins = collect($adminRecords)->map(function($admin, $index){
            return [
                "index" => $index+1,
                "name" => '<img src="'.$admin->image_path.'" alt="'.$admin->name.'"> '.$admin->name,
                "role" => $admin->roles[0]->name,
                "email" => $admin->email,
                "mobile" => $admin->mobile,
                "gender" => trans(config('dashboard.trans_file').$admin->gender),
                "country" => $admin->country->name,
                "action" => $admin->id
            ];
        })->toArray();

        if(in_array($columnName, $excludeOrderColumnFromSql))
        {
            $admins = $this->sortViaColumn($admins, $columnName, $columnSortOrder);
        }

        return ['draw' => $draw, 'totalRecordswithFilter' => $totalRecordswithFilter, 'admins' => $admins, 'columnNames' => $columnNames];
    }
    // === End function ===

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $roles = Role::all();
        $pageTitle = trans(config('dashboard.trans_file').'add_new');
        $submitFormRoute = route('admins.store');
        $submitFormMethod = 'post';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('countries', 'roles', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $imageName = null;

        if($request->hasFile('image'))
        {
            $imageName = $this->uploadImage($request->image, $this->storageFolder);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'image' => $imageName,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
        ]);

        $this->assignRole($admin, $request->role);
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_save')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $roles = Role::all();
        $admin = Admin::find($id);
        $pageTitle = trans(config('dashboard.trans_file').'edit');
        $submitFormRoute = route('admins.update', $id);
        $submitFormMethod = 'put';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('countries', 'roles', 'admin', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::find($id);

        if($request->image_remove)
        {
            $this->removeImage($admin->image, $this->storageFolder);
            $admin->image = null;
        }

        if($request->hasFile('image'))
        {
            $this->removeImage($admin->image, $this->storageFolder);
            $admin->image = $this->uploadImage($request->image, $this->storageFolder);
        }

        if(strlen(trim($request->password)) > 0)
        {
            $admin->password = bcrypt($request->password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->gender = $request->gender;
        $admin->country_id = $request->country_id;
        $admin->save();
        $this->assignRole($admin, $request->role);
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_save')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->guard('admin')->user()->id == $id)
        {
            return $this->successResponse(['message' => trans(config('dashboard.trans_file').'cannot_delete_your_account')], 400);
        }
        $existingAdmin = Admin::find($id);
        $this->removeImage($existingAdmin->image, $this->storageFolder);
        $existingAdmin->delete();
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_delete')]);
    }

    // === Assign or update role to admin ===
    private function assignRole($admin, $roleId)
    {
        $admin->roles()->detach();
        $role = Role::find($roleId);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $admin->assignRole($roleId);
    }
    // === End function ===
}
