<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Admin\ModelPart as Model;
use App\Models\Admin\Part;
use Illuminate\Support\Facades\Validator;

class ModelPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $models = Model::select('id', 'name')->with('parts:id,name')->orderBy('name', 'ASC')->get();
        $parts = Part::select('id', 'name')->orderBy('name', 'ASC')->get();
        return view('admins.model-part', compact('models', 'parts'));
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'model_name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation error', $validator->errors(), 422);
        }

        $data = Model::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->model_name]
        );
        return $this->successResponse($data, $data->name . " successfully added / updated");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
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
    public function update(Request $request, string $id)
    {
        $data = Model::select('id', 'name')->find($id);
        $data->parts()->sync($request->parts);
        return $this->successResponse($data, "Successfully synchronization " . $data->name . " and Parts");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Model::find($id);
        $model->delete();
        return $this->successResponse($model, $model->name . ' successfully deleted');
    }

    public function searchModel(Request $request)
    {
        $keywords = $request->keywords;
        $data = Model::select('id', 'name')->where('name', 'like', '%' . $keywords . '%')->get();
        return $this->successResponse($data, 'Fetch data for ' . $keywords);
    }
}
