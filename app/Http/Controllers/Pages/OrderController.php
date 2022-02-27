<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;
use App\Facades\Cart;
use App\Models\Order;
use App\Models\Status;
use App\Models\Vendor;
use App\Facades\Furnish;
use App\Jobs\CreateOrder;
use App\Models\OrderDetail;
use App\Events\OrderWasCreated;
use App\Services\SaveCodeService;
use App\Events\OrderWasChannelled;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index(Vendor $vendor)
    {
        return view('pages.vendor.order',[
            'orders' => Order::where('vendor_id', $vendor->id())->get(),
            'vendor' => $vendor
        ]);
    }

    public function show(User $user)
    {
        return view('pages.profile.order',[
            'orders' => Order::where('author_id', $user->id)->get(),
            'user' => $user
        ]);
    }

    public function store(OrderRequest $request)
    {        
            $this->dispatchSync(CreateOrder::fromRequest($request));

            $notification = array(
                'message'        => 'Order sent successfully',
                'alert-type'     => 'success',
            );
            return redirect()->route('smilee.products.index')->with($notification);
    }
}
