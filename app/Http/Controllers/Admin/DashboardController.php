<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\User;
use App\Models\Agent;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Writer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
       return $this->middleware(['admin', 'auth']);
    }

    public function index()
    {
        return view('admin.index',[
            'users' => User::all(),
            'agents' => Agent::all(),
            'vendors' => Vendor::all(),
            'writers' => Writer::all(),
            'products' => Product::all(),
            'orders' => Order::all(),
            'banks' => Bank::all(),
        ]);
    }
}
