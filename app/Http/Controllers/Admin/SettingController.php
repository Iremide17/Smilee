<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('admin.setting.index');
    }
}
