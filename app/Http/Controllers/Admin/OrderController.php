<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
       return $this->middleware(['admin', 'auth']);
    }

    public function index()
    {
        return view('admin.order.index');
    }
}
