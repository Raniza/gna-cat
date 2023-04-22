<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ModelPart as Model;
use App\Models\Admin\Part;
use App\Models\Admin\MainProcess;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Exception;

class PartProcessStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Model::select('id', 'name')->with(['parts:id,name', 'processes:id,name'])->orderBy('name', 'ASC')->get();
        $main_processes = MainProcess::select('id', 'name')
            ->with(['processes' => function ($q) {
                $q->select('id', 'name', 'main_process_id')->orderBy('name', 'ASC');
            }])
            ->get();
        return view('admins.part-process', compact('models', 'main_processes'));
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
        $validator = Validator::make($request->all(), [
            'model_id' => 'required',
            'part_id' => 'required',
            'main_process_id' => 'required',
            'process_id' => 'required'
        ], [
            'model_id' => 'Please choose model',
            'part_id' => 'Please choose part',
            'main_process_id' => 'Please choose main process',
            'process_id' => 'Please select for part process'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse('Validation error', $validator->errors(), 422);
        }

        $part_id = $request->part_id;
        $model_id = $request->model_id;
        $main_process_id = $request->main_process_id;
        $process_id = $request->process_id;

        DB::beginTransaction();
        try {
            $processes = Model::find($model_id)->processes()->wherePivot('part_id', $part_id)->wherePivot('main_process_id', $main_process_id);
            $processes = $processes->syncWithPivotValues($process_id, [
                'main_process_id' => $main_process_id,
                'model_id' => $model_id,
                'part_id' => $part_id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $errMsg = $e->getMessage();
            return $this->errorResponse('Failed to save data', $errMsg, 417);
        }
        DB::commit();
        
        $data = Model::select('id', 'name')->with([
            'parts' => function($query) use($part_id) {
                $query->select('id', 'name')->where('part_id', $part_id);
            },
            'processes' => function($query) use($model_id, $part_id, $main_process_id) {
                $query->select('id', 'name')->wherePivot('model_id', $model_id)->wherePivot('part_id', $part_id)->wherePivot('main_process_id', $main_process_id)->get();
            }
        ])->find($model_id);
        return $this->successResponse($data, 'Proccess for ' .$data['name']. '-' .$data['parts'][0]['name']. ' data, successfully synchronise');
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
    public function destroy($id)
    {
        //
    }
}
