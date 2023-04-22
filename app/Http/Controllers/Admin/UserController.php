<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin\Position;
use App\Models\Admin\Department;
use App\Models\Admin\Section;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['position:id,name', 'department:id,name', 'section:id,name'])->paginate(25);
        $positions = Position::select('id', 'name')->orderBy('name', 'asc')->get();
        $departments = Department::with('sections:id,name,department_id')->select('id', 'name')->get();
        return view('admins.user', compact('users', 'positions', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik,' . $request->id,
            'userName' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'department' => 'required',
            'section' => 'required',
            'isAdmin' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->errorResponse('Validation errors', $validator->errors(), 422);
        }

        if ($request->id) {
            $user = User::where('id', $request->id)->update(
                [
                    'nik' => $request->nik,
                    'name' => $request->userName,
                    'email' => $request->email,
                    'position_id' => $request->position,
                    'department_id' => $request->department,
                    'section_id' => $request->section,
                    'isAdmin' => $request->isAdmin
                ]
            );
        } else {
            $user = User::create([
                'nik' => $request->nik,
                'name' => $request->userName,
                'password' => Hash::make($request->nik),
                'email' => $request->email,
                'position_id' => $request->position,
                'department_id' => $request->department,
                'section_id' => $request->section,
                'isAdmin' => $request->isAdmin
            ]);
        }

        return $this->successResponse($user, "User successfully saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return $this->successResponse($user, $user->name . " successfully deleted");
    }

    public function userSearch(Request $request)
    {
        if (!$request->keywords) {
            return redirect()->route('admin.user.index');
        }
        $users = User::with(['position:id,name', 'department:id,name', 'section:id,name'])->orderBy('name')
            ->where('name', 'like', '%'. $request->keywords. '%')->paginate(25);
        $positions = Position::select('id', 'name')->orderBy('name', 'asc')->get();
        $departments = Department::with('sections:id,name,department_id')->select('id', 'name')->get();
        return view('admins.user', compact('users', 'positions', 'departments'));
    }
}
