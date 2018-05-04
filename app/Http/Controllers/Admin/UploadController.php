<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class UploadController extends Controller
{
    public function images(Request $request)
    {

        $data = $request->file();
        dd($data);
        //return response()->json($data);
    }
}
