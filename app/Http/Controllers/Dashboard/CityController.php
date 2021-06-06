<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Http\Requests\Dashboard\CityRequest;
use PDF;

class CityController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'cities.';
        $this->middleware('permission:city-list,admin', ['only' => ['index','show']]);
        $this->middleware('permission:city-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:city-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:city-delete,admin', ['only' => ['destroy']]);
    }

    public function downloadPdf(Request $request)
    {
        return response()->json(['path' => route('cities.index', ['download-pdf' => true, 'request' => $request->all()])]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::all();
        $totalResults = City::count();

        if($request->has('download-pdf'))
        {
            $request = new Request($request->all()['request']);
            $filter = $this->datatableFilter($request);
            $cities = $filter['cities'];
            $visibleColsNames = $request->visibleColsNames;
            $colsIndexName = $request->colsIndexName;
            $html = view(config('dashboard.resource_folder').$this->controllerResource.'pdf', compact('cities', 'visibleColsNames', 'colsIndexName'))->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->download(trans(config('dashboard.trans_file').'cities').'.pdf');
        }

        if($request->ajax())
        {
            $filterData = $this->datatableFilter($request);
            $response = ["draw" => intval($filterData['draw']),
                            "iTotalRecords" => $totalResults,
                            "iTotalDisplayRecords" => $filterData['totalRecordswithFilter'],
                            "aaData" => $filterData['cities']];

            echo json_encode($response);
        }
        else
        {
            return view(config('dashboard.resource_folder').$this->controllerResource.'index', compact('totalResults', 'countries'));
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

        $model = (new City)->newQuery();

        if($request->filled('search_keyword'))
        {
            $model->where('name', 'like', '%'.$request->search_keyword.'%');
        }
        if($request->filled('status'))
        {
            $model->where('status', $request->status);
        }
        if($request->filled('country_id'))
        {
            $model->where('country_id', $request->country_id);
        }

        // === Filter records if there is search keyword ===
        $totalRecordswithFilter = $model->count();

        // === Fetch records ===
        $excludeOrderColumnFromSql = ['country'];
        if(!in_array($columnName, $excludeOrderColumnFromSql))
        {
            $model->orderBy($columnName,$columnSortOrder);
        }

        $citiesRecords = $model->skip($start)->take($rowsPerPage)->get();

        $cities = collect($citiesRecords)->map(function($city, $index){
            return [
                "index" => $index+1,
                "name" => $city->name,
                "country" => $city->country->name,
                "status" => $city->status_label,
                "action" => $city->id
            ];
        })->toArray();

        if(in_array($columnName, $excludeOrderColumnFromSql))
        {
            $cities = $this->sortViaColumn($cities, $columnName, $columnSortOrder);
        }

        return ['draw' => $draw, 'totalRecordswithFilter' => $totalRecordswithFilter, 'cities' => $cities, 'columnNames' => $columnNames];
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
        $pageTitle = trans(config('dashboard.trans_file').'add_new');
        $submitFormRoute = route('cities.store');
        $submitFormMethod = 'post';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('countries', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        City::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
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
        $city = City::find($id);
        $countries = Country::all();
        $pageTitle = trans(config('dashboard.trans_file').'edit');
        $submitFormRoute = route('cities.update', $id);
        $submitFormMethod = 'put';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('city', 'countries', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $city = City::find($id);
        $city->name = $request->name;
        $city->country_id = $request->country_id;
        $city->status = $request->has('status') ? '1' : '0';
        $city->save();
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
        $existingCity = City::find($id);
        $existingCity->delete();
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_delete')]);
    }

    // === Retrive cities via country id ===
    public function countryCities($countryId)
    {
        $cities = City::where('country_id', $countryId)->get();
        return $this->successResponse(['cities' => $cities]);
    }
    // === End function ===

}
