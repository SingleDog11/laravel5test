<?php

namespace App\Http\Controllers\Util;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class UploadfileController extends Controller
{
    //
    public function index()
    {
        return view ("uploadfile");
    }
    public function showUploadFile(Request $request)
    {
        echo "gothere";
        $file = $request->file('image');
        
        // 显示文件名称
        echo "File Name : " .$file->getClientOriginalName() ;
        echo "<br>";

        // 显示文件后缀
        echo "File Extension : " .$file->getClientOriginalExtension();
        echo "<br>";

        // 显示文件真是路径

        echo "File Real Path : ". $file->getRealPath();
        echo "<br>";

        // 显示文件大小
        echo "File Size : " .$file->getSize();
        echo "<br>";

        // 显示文件Mime Type
        echo "FIle Mime Type : ".$file->getMimeType();

        // 将Request的文件保存到本地
        $destinationPath = "uploads";
        $file->move($destinationPath,$file->getClientOriginalName());
    }
}
