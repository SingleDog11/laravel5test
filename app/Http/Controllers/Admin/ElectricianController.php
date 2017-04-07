<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Electrician ;

class ElectricianController extends Controller
{
    // 
    public function index()
    {
        return view('admin/electrician/index')->withElectricians(Electrician::all());
    }
    public function create()
    {
        return view('admin/electrician/create');
    }
    public function store(Request $request)  
    {
        $this->validate($request, [
            'name' => 'required|unique:electricians|max:255',
            'password' => 'required',
        ]);

        $electrician = new Electrician;
        $electrician->name = $request->get('name');
        $electrician->password = $request->get('password');

        if ($electrician->save()) {
            return redirect('admin/electrician');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

}
