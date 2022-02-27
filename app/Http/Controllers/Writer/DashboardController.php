<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
       return $this->middleware(['writer', 'verified']);
    }

    public function index()
    {
        return view('writer.index');
    }
}
