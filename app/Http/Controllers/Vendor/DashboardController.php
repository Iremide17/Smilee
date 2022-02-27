<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
       return $this->middleware(['vendor', 'auth']);
    }

    public function index()
    {
        return view('vendors.index');
    }
}
