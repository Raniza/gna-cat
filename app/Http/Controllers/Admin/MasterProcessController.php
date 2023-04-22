<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\MainProcess;
use App\Models\Admin\MasterProcess as Process;

class MasterProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_process = MainProcess::select('id', 'name')->get();
        $process = Process::select('id', 'name', 'main_process_id')->orderBy('name', 'ASC')->get();
        return view('admins.process', compact('process', 'main_process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mode = $request->mode;
        $validator = Validator::make($request->all(), [
            'process_name' => 'required',
            'main_process_id' => $mode !== 'main' ? 'required' : '',
        ],[
            'main_process_id.required' => "Main process must be choosen"
        ]);
        if ($validator->fails()) {
            return $this->errorResponse('Validation error', $validator->errors(), 422);
        }
        
        switch ($mode) {
            case 'main':
                $data = MainProcess::updateOrCreate(
                    ['id' => $request->id],
                    ['name' => $request->process_name]
                );
                break;
            
            default:
                $data = Process::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'name' => $request->process_name,
                        'main_process_id' => $request->main_process_id,
                    ],
                );
                break;
        }
        return $this->successResponse($data, $data->name . ' successfully added / updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MainProcess::select('id', 'name')->with('processes', function($query){
            $query->select('id', 'name', 'main_process_id')->orderBy('name', 'ASC');
        })->find($id);
        return $this->successResponse($data, 'Fetch success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $mode = $request->mode;
        switch ($mode) {
            case 'main':
                $data = MainProcess::find($id);
                break;
            
            default:
                $data = Process::find($id);
                break;
        }
        $data->delete();
        return $this->successResponse($data, $data->name . ' successfuly deleted');
    }
    public function searchProcess(Request $request)
    {
        $keywords = $request->keywords;
        $data = Process::select('id', 'name')->where('name', 'like', '%' . $keywords . '%')->orderBy('name', 'ASC')->get();
        return $this->successResponse($data, "Fetch for " . $keywords);
    }
}
