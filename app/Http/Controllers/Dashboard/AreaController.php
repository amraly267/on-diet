<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Area;
use App\Http\Requests\Dashboard\AreaRequest;
use PDF;

class AreaController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'areas.';
        $this->middleware('permission:area-list,admin', ['only' => ['index','show']]);
        $this->middleware('permission:area-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:area-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:area-delete,admin', ['only' => ['destroy']]);
    }

    public function downloadPdf(Request $request)
    {
        return response()->json(['path' => route('areas.index', ['download-pdf' => true, 'request' => $request->all()])]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::all();
        $totalResults = Area::count();

        if($request->has('download-pdf'))
        {
            $request = new Request($request->all()['request']);
            $filter = $this->datatableFilter($request);
            $areas = $filter['areas'];
            $visibleColsNames = $request->visibleColsNames;
            $colsIndexName = $request->colsIndexName;
            $html = view(config('dashboard.resource_folder').$this->controllerResource.'pdf', compact('areas', 'visibleColsNames', 'colsIndexName'))->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->download(trans(config('dashboard.trans_file').'areas').'.pdf');
        }

        if($request->ajax())
        {
            $filterData = $this->datatableFilter($request);
            $response = ["draw" => intval($filterData['draw']),
                            "iTotalRecords" => $totalResults,
                            "iTotalDisplayRecords" => $filterData['totalRecordswithFilter'],
                            "aaData" => $filterData['areas']];

            echo json_encode($response);
        }
        else
        {
            return view(config('dashboard.resource_folder').$this->controllerResource.'index', compact('totalResults', 'cities'));
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

        $model = (new Area)->newQuery();

        if($request->filled('search_keyword'))
        {
            $model->where('name', 'like', '%' .$request->search_keyword . '%');
        }
        if($request->filled('status'))
        {
            $model->where('status', $request->status);
        }
        if($request->filled('city_id'))
        {
            $model->where('city_id', $request->city_id);
        }

        // === Filter records if there is search keyword ===
        $totalRecordswithFilter = $model->count();

        // === Fetch records ===
        $excludeOrderColumnFromSql = ['city'];
        if(!in_array($columnName, $excludeOrderColumnFromSql))
        {
            $model->orderBy($columnName,$columnSortOrder);
        }

        $areasRecords = $model->skip($start)->take($rowsPerPage)->get();

        $areas = collect($areasRecords)->map(function($area, $index){
            return [
                "index" => $index+1,
                "name" => $area->name,
                "city" => $area->city->name,
                "status" => $area->status_label,
                "action" => $area->id
            ];
        })->toArray();

        if(in_array($columnName, $excludeOrderColumnFromSql))
        {
            $areas = $this->sortViaColumn($areas, $columnName, $columnSortOrder);
        }

        return ['draw' => $draw, 'totalRecordswithFilter' => $totalRecordswithFilter, 'areas' => $areas, 'columnNames' => $columnNames];
    }
    // === End function ===

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $pageTitle = trans(config('dashboard.trans_file').'add_new');
        $submitFormRoute = route('areas.store');
        $submitFormMethod = 'post';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('cities', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        Area::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'status' => $request->has('status') ? '1' : '0',
        ]);

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
        $area = Area::find($id);
        $cities = City::all();
        $pageTitle = trans(config('dashboard.trans_file').'edit');
        $submitFormRoute = route('areas.update', $id);
        $submitFormMethod = 'put';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('area', 'cities', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $area = Area::find($id);
        $area->name = $request->name;
        $area->city_id = $request->city_id;
        $area->status = $request->has('status') ? '1' : '0';
        $area->save();
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
        $existingArea = Area::find($id);
        $existingArea->delete();
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_delete')]);
    }

    // === Retrive areas via city id ===
    public function cityAreas($cityId)
    {
        $areas = Area::where('city_id', $cityId)->get();
        return $this->successResponse(['areas' => $areas]);
    }
    // === End function ==
}
