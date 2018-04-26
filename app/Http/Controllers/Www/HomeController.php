<?php

namespace App\Http\Controllers\Www;

use Illuminate\Http\Request;
use App\Http\Controllers\Www\BaseController as Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
