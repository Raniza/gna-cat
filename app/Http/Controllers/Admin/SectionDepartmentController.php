<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Department;
use App\Models\Admin\Section;

class SectionDepartmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sections = Section::select('id', 'name', 'department_id')->get();
        $departments = Department::with('sections:id,name,department_id')->select('id', 'name')->get();
        return view('admins.department-section', compact('departments', 'sections'));
    }
}
