<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Requests\Dashboard\CountryRequest;
use PDF;

class CountryController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'countries.';
        $this->storageFolder = Country::storageFolder();
        $this->middleware('permission:country-list,admin', ['only' => ['index','show']]);
        $this->middleware('permission:country-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:country-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:country-delete,admin', ['only' => ['destroy']]);
    }

    public function downloadPdf(Request $request)
    {
        return response()->json(['path' => route('countries.index', ['download-pdf' => true, 'request' => $request->all()])]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalResults = Country::count();

        if($request->has('download-pdf'))
        {
            $request = new Request($request->all()['request']);
            $filter = $this->datatableFilter($request);
            $countries = $filter['countries'];
            $visibleColsNames = $request->visibleColsNames;
            $colsIndexName = $request->colsIndexName;
            $html = view(config('dashboard.resource_folder').$this->controllerResource.'pdf', compact('countries', 'visibleColsNames', 'colsIndexName'))->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->download(trans(config('dashboard.trans_file').'countries').'.pdf');
        }

        if($request->ajax())
        {
            $filterData = $this->datatableFilter($request);
            $response = ["draw" => intval($filterData['draw']),
                            "iTotalRecords" => $totalResults,
                            "iTotalDisplayRecords" => $filterData['totalRecordswithFilter'],
                            "aaData" => $filterData['countries']];

            echo json_encode($response);
        }
        else
        {
            return view(config('dashboard.resource_folder').$this->controllerResource.'index', compact('totalResults'));
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

        $model = (new Country)->newQuery();

        if($request->filled('search_keyword'))
        {
            $model->where(function($q) use ($request){
                $q->where('name', 'like', '%'.$request->search_keyword.'%')
                ->orWhere('name_code', 'like', '%'.$request->search_keyword.'%')
                ->orWhere('phone_code', 'like', '%'.$request->search_keyword.'%');
            });
        }
        if($request->filled('status'))
        {
            $model->where('status', $request->status);
        }

        // === Filter records if there is search keyword ===
        $totalRecordswithFilter = $model->count();

        // === Fetch records ===
        $countriesRecords = $model->orderBy($columnName,$columnSortOrder)->skip($start)->take($rowsPerPage)->get();

        $countries = collect($countriesRecords)->map(function($country, $index){
            return [
                "index" => $index+1,
                "name" => '<img src="'.$country->flag_path.'" alt="'.$country->name.'"> '.$country->name,
                "name_code" => $country->name_code,
                "phone_code" => $country->phone_code,
                "status" => $country->status_label,
                "action" => $country->id
            ];
        });
        return ['draw' => $draw, 'totalRecordswithFilter' => $totalRecordswithFilter, 'countries' => $countries, 'columnNames' => $columnNames];
    }
    // === End function ===

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = trans(config('dashboard.trans_file').'add_new');
        $submitFormRoute = route('countries.store');
        $submitFormMethod = 'post';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $flagName = null;

        if($request->hasFile('flag'))
        {
            $flagName = $this->uploadImage($request->flag, $this->storageFolder);
        }

        Country::create([
            'name' => $request->name,
            'name_code' => $request->name_code,
            'phone_code' => $request->phone_code,
            'flag' => $flagName,
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
        $country = Country::find($id);
        $pageTitle = trans(config('dashboard.trans_file').'edit');
        $submitFormRoute = route('countries.update', $id);
        $submitFormMethod = 'put';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('country', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        $country = Country::find($id);

        if($request->flag_remove)
        {
            $this->removeImage($country->flag, $this->storageFolder);
            $country->flag = null;
        }

        if($request->hasFile('flag'))
        {
            $this->removeImage($country->flag, $this->storageFolder);
            $country->flag = $this->uploadImage($request->flag, $this->storageFolder);
        }

        $country->name = $request->name;
        $country->name_code = $request->name_code;
        $country->phone_code = $request->phone_code;
        $country->status = $request->has('status') ? '1' : '0';
        $country->save();
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
        $existingCountry = Country::find($id);
        $this->removeImage($existingCountry->flag, $this->storageFolder);
        $existingCountry->delete();
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_delete')]);
    }
}
