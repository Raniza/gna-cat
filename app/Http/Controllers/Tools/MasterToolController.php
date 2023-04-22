<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Tools\MasterTool as MT;
use App\Models\Tools\ToolDrawing as DWG;
use App\Models\User;
use DataTables;
use Exception;

class MasterToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('tools.master-tool');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $data = MT::with('drawings')->find($id);
        // $newCreated = explode(' ', $data->created_at);
        $data['create'] = explode(' ', $data->created_at)[0];
        $data['update'] = explode(' ', $data->updated_at)[0];
        return $this->successResponse($data, $data->code . ' fecth successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }

    public function getMasterTool(Request $request)
    {
        if ($request->ajax()) {
            $data = MT::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('drawing', function($data) {
                    if (count($data->drawings) > 0) {
                        $path = asset('storage/' . $data->drawings()->latest()->first()->drawing);
                        $rev = $data->drawings()->latest()->first()->rev_no;
                        $drawing = '<a href="' .$path. '" target="_blank" class="drawing btn badge rounded-pill text-bg-success p-1" style="text-decoration:none;" title="Rev-'.$rev . '" data-bs-toggle="tooltip" data-bs-placement="top">View</a>';
                    } else {
                        $drawing = '<a href="javascript:void(0)" onclick="openUploadDwg(event)" data-id="' .$data->id . '" class="upload btn badge rounded-pill text-bg-warning p-1" data-bs-toggle="modal" data-bs-target="#uploadToolModal" style="text-decoration:none;">Upload</a>';
                    }
                    return $drawing;
                })
                ->addColumn('action', function($row) {
                    $actionBtn = '<a href="javascript:void(0)" onclick="deleteMasterTool(event)" data-id="' .$row->id. '" class="delete btn badge rounded-pill text-bg-danger p-1" style="text-decoration:none;">Delete</a>';
                    return $actionBtn;
                })
                ->escapeColumns([]) // Untuk membuat html view anchor (jika tidak pakai ini, yang muncul string)
                ->rawColumns(['action'])
                ->setRowClass(function ($user) {
                    return 'dt-on-hover';
                })
                ->make('true');
        }
    }

    public function toolDwgUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tool_id' => ['required'],
            'tool_drawing' => ['required', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'tool_rev_no' => ['required', 'min:1'],
            'tool_note' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation errors', $validator->errors(), 422);
        }

        try {
            $ext = $request->file('tool_drawing')->getClientOriginalExtension();
            $file_name = MT::find($request->tool_id)->code . '_R' . $request->tool_rev_no . '.' . $ext;
            // $path = $request->file('tool_drawing')->storeAs('tools', $file_name);
            $path = Storage::disk('public')->putFileAs('tools', $request->file('tool_drawing'), $file_name);
        } catch (Exception $exception) {
            return $this->errorResponse('Upload file errors', $exception->getMessage(), 400);
        }
        
        try {
            $dwg = DWG::create([
                'master_tool_id' => $request->tool_id,
                'drawing' => $path,
                'rev_no' => $request->tool_rev_no,
                'note' => $request->tool_note,
                'uploader' => auth()->user()->id
            ]);
        } catch (Exception $exception) {
            Storage::delete($path);
            return $this->errorResponse('Inserting data error', $exception->getMessage(), 400);
        }
        return $this->successResponse($path, "Drawing successfully upload");
    }
}
