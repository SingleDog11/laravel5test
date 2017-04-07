<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inspactor ;

class InspactorController extends Controller
{
    //
    public function index()
    {
        return view('admin/inspactor/index')->withInspactors(Inspactor::all());
    }
    public function create()
    {
        return view('admin/inspactor/create');
    }
    public function store(Request $request)  
    {
        $this->validate($request, [
            'name' => 'required|unique:inspactors|max:255',
            'password' => 'required',
        ]);

        $inspactor = new Inspactor;
        $inspactor->name = $request->get('name');
        $inspactor->password = $request->get('password');

        if ($inspactor->save()) {
            return redirect('admin/inspactor');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

}
