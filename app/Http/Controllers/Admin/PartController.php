<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Part;
use App\Models\Admin\ModelPart as Model;
use Illuminate\Support\Facades\Validator;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'part_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse('Validation error', $validator->errors(), 422);
        }
        $data = Part::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->part_name]
        );
        return $this->successResponse($data, $data->name . " successfully added / updated");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // $id >> for Model ID
    {
        $data = Model::with('parts:id,name')->find($id)->parts;
        return $this->successResponse($data, "Successfully fetch part by model id");
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
        $data = Part::find($id);
        $data->delete();
        return $this->successResponse($data, $data->name . ' successfully deleted');
    }

    public function searchPart(Request $request)
    {
        $keywords = $request->keywords;
        $data = Part::select('id', 'name')->where('name', 'like', '%' . $keywords . '%')->orderBy('name', 'ASC')->get();
        return $this->successResponse($data, 'Fetch data for ' . $keywords);
    }
}
