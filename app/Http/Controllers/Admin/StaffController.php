<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Staff;

class StaffController extends Controller
{
    //
    public function index()
    {
        return view('admin/staff/index')->withStaffs(Staff::all());
    }

    public function create()
    {
        return view ('admin/staff/create');
    }
}
