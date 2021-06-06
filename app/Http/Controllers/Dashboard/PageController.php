<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\Dashboard\PageRequest;
use PDF;

class PageController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'pages.';
        $this->middleware('permission:page-list,admin', ['only' => ['index','show']]);
        $this->middleware('permission:page-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:page-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:page-delete,admin', ['only' => ['destroy']]);
    }

    public function downloadPdf(Request $request)
    {
        return response()->json(['path' => route('pages.index', ['download-pdf' => true, 'request' => $request->all()])]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalResults = Page::count();

        if($request->has('download-pdf'))
        {
            $request = new Request($request->all()['request']);
            $filter = $this->datatableFilter($request);
            $pages = $filter['pages'];
            $visibleColsNames = $request->visibleColsNames;
            $colsIndexName = $request->colsIndexName;
            $html = view(config('dashboard.resource_folder').$this->controllerResource.'pdf', compact('pages', 'visibleColsNames', 'colsIndexName'))->render();
            $pdf = PDF::loadHTML($html);
            return $pdf->download(trans(config('dashboard.trans_file').'static_pages').'.pdf');
        }

        if($request->ajax())
        {
            $filterData = $this->datatableFilter($request);
            $response = ["draw" => intval($filterData['draw']),
                            "iTotalRecords" => $totalResults,
                            "iTotalDisplayRecords" => $filterData['totalRecordswithFilter'],
                            "aaData" => $filterData['pages']];

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

        $model = (new Page)->newQuery();

        if($request->filled('search_keyword'))
        {
            $model->where('title', 'like', '%' .$request->search_keyword . '%');
        }
        if($request->filled('status'))
        {
            $model->where('status', $request->status);
        }
        if($request->filled('is_web'))
        {
            $model->where('is_web', $request->is_web);
        }
        if($request->filled('is_mobile'))
        {
            $model->where('is_mobile', $request->is_mobile);
        }

        // === Filter records if there is search keyword ===
        $totalRecordswithFilter = $model->count();

        // === Fetch records ===
        $pagesRecords = $model->orderBy($columnName,$columnSortOrder)->skip($start)->take($rowsPerPage)->get();

        $pages = collect($pagesRecords)->map(function($page, $index){
            return [
                "index" => $index+1,
                "title" => $page->title,
                "is_web" => $page->is_web_label,
                "is_mobile" => $page->is_mobile_label,
                "status" => $page->status_label,
                "action" => $page->id
            ];
        });

        return ['draw' => $draw, 'totalRecordswithFilter' => $totalRecordswithFilter, 'pages' => $pages, 'columnNames' => $columnNames];
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
        $submitFormRoute = route('pages.store');
        $submitFormMethod = 'post';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->has('status') ? '1' : '0',
            'is_web' => $request->has('is_web') ? '1' : '0',
            'is_mobile' => $request->has('is_mobile') ? '1' : '0',
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
        $page = Page::find($id);
        $pageTitle = trans(config('dashboard.trans_file').'edit');
        $submitFormRoute = route('pages.update', $id);
        $submitFormMethod = 'put';
        return view(config('dashboard.resource_folder').$this->controllerResource.'form', compact('page', 'pageTitle', 'submitFormRoute', 'submitFormMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        $page->title = $request->title;
        $page->description = $request->description;
        $page->status = $request->has('status') ? '1' : '0';
        $page->is_web = $request->has('is_web') ? '1' : '0';
        $page->is_mobile = $request->has('is_mobile') ? '1' : '0';
        $page->save();
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
        Page::where('id', $id)->delete();
        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_delete')]);
    }
}
