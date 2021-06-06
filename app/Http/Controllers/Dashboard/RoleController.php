<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Models\PermissionGroup;
use app\Models\Admin;
use PDF;

class RoleController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'roles.';
        $this->middleware('permission:role-list,admin', ['only' => ['index','show']]);
        $this->middleware('permission:role-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete,admin', ['only' => ['destroy']]);
    }

    public function downloadPdf(Request $request)
    {
        return response()->json(['path' => route('roles.index', ['download-pdf' => true, 'request' => $request->all()])]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $permissions = Permission::get();
        $totalResults = Role::count();

        if($request->has('download-pdf'))
        {
            $request = new Request($request->all()['request']);
            $filter = $this->datatableFilter($request);
            $roles = $filter['roles'];
            $visibleColsNames = $request->visibleColsNames;
            $colsIndexName = $request->colsIndexName;
            $html = view(config('dashboard.resource_folder').$this->controllerResource.'pdf', compact('roles', 'visibleColsNames', 'colsIndexName'))->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->download(trans(config('dashboard.trans_file').'roles').'.pdf');
        }

        if($request->ajax())
        {
            $filterData = $this->datatableFilter($request);
            $response = ["draw" => intval($filterData['draw']),
                            "iTotalRecords" => $totalResults,
                            "iTotalDisplayRecords" => $filterData['totalRecordswithFilter'],
                            "aaData" => $filterData['roles']];

            echo json_encode($response);
        }
        else
        {
            return view(config('dashboard.resource_folder').$this->controllerResource.'index', compact('totalResults', 'permissions'));
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

        $model = (new Role)->newQuery();

        if($request->filled('search_keyword'))
        {
            $model->where('name', 'like', '%'.$request->search_keyword.'%');
        }
        if($request->filled('permission'))
        {
            $model->whereHas('permissions', function($q) use ($request){$q->where('id', $request->permission);});
        }

        // === Filter records if there is search keyword ===
        $totalRecordswithFilter = $model->count();

        // === Fetch records ===
        $roleRecords = $model->orderBy($columnName,$columnSortOrder)->skip($start)->take($rowsPerPage)->get();

        $roles = collect($roleRecords)->map(function($role, $index){
            $permissions = '';
            foreach($role->permissions as $permission)
            {
                $permissions .= '<span class="badge badge-light-success">'.$permission->name.'</span> ';
            }
            return [
                "index" => $index+1,
                "name" => $role->name,
                "permissions" => $permissions,
                "action" => $role->id
            ];
        });
        return ['draw' => $draw, 'totalRecordswithFilter' => $totalRecordswithFilter, 'roles' => $roles, 'columnNames' => $columnNames];
    }
    // === End function ===

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = PermissionGroup::get();
        $pageTitle = trans(config('dashboard.trans_file').'add_new');
        $submitFormRoute = route('roles.store');
        $submitFormMethod = 'post';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('permissions', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
        $role->syncPermissions($request->permissions);
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
        $permissions = PermissionGroup::all();
        $role = Role::with('permissions')->find($id);

        $relatedPermissions = Permission::whereHas('roles', function($q) use ($role){
            $q->where('name', $role->name);
        })->pluck('id')->toArray();

        $pageTitle = trans(config('dashboard.trans_file').'edit');
        $submitFormRoute = route('roles.update', $id);
        $submitFormMethod = 'put';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('relatedPermissions', 'permissions', 'role', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->guard_name = 'admin';
        $role->save();
        $role->syncPermissions($request->permissions);
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
        $role = Role::where('id', $id)->delete();
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_delete')]);
    }
}
