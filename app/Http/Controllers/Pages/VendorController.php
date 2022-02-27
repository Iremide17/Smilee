<?php

namespace App\Http\Controllers\Pages;

use App\Models\Vendor;
use App\Jobs\CreateVendor;
use App\Jobs\UpdateVendor;
use Illuminate\Http\Request;
use App\Policies\VendorPolicy;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVendor as RequestsUpdateVendor;
use App\Http\Requests\VendorRequest;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SubscribeToSubscriptionAble;
use App\Jobs\UnsubscribeFromSubscriptionAble;

class VendorController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('pages.vendor.index');
    }

    public function show(Vendor $vendor)
    {
        $expireAt = now()->addHours(12);

        views($vendor)
            ->cooldown($expireAt)
            ->record();
            
        return view('pages.vendor.show', [
            'vendor' => $vendor,
        ]);
    }

    public function store(VendorRequest $request)
    {
        $check = Vendor::where('user_id', Auth::id())->first();

       if (!$check) {
            $this->dispatchSync(CreateVendor::fromRequest($request));
            $notification = array(
                'message' => 'You have successfully sent an application to become a vendor. Your application will be reviewed and necessary documentation will be sent to you on approval',
                'alert-type' => 'success',
            );
            return redirect()->to('/dashboard')->with($notification);  
       }
       else
       {
            $notification = array(
                'message' => 'You have registered already!',
                'alert-type' => 'info',
            );
            return redirect()->to('/dashboard')->with($notification);  
       }     
    }

    public function update(RequestsUpdateVendor $request, Vendor $vendor)
    {
        $this->dispatchSync(UpdateVendor::fromRequest($vendor, $request));
        $notification = array(
            'message' => 'Congratulations! Your profile has been updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }


    public function subscribe(Request $request, Vendor $vendor)
    {
        $this->authorize(VendorPolicy::SUBSCRIBE, $vendor);

        $this->dispatchSync(new SubscribeToSubscriptionAble($request->user(), $vendor));

        return redirect()->route('smilee.vendors.show', $vendor)
            ->with('success', 'You have been subscribed to this vendor');
    }

    public function unsubscribe(Request $request, Vendor $vendor)
    {
        $this->authorize(VendorPolicy::UNSUBSCRIBE, $vendor);

        $this->dispatchSync(new UnsubscribeFromSubscriptionAble($request->user(), $vendor));

        return redirect()->route('smilee.vendors.show', $vendor)
            ->with('success', 'You have been unsubscribed from this vendor');
    }

}
