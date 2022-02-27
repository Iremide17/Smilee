<?php

namespace App\Jobs;

use App\Facades\Cart;
use App\Models\Order;
use App\Models\Status;
use App\Facades\Furnish;
use App\Models\OrderDetail;
use App\Events\OrderWasCreated;
use App\Services\SaveCodeService;
use App\Events\OrderWasChannelled;
use App\Http\Requests\OrderRequest;
use App\Models\BillingAddress;
use App\Models\OrderTracker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateOrder
{
    use Dispatchable;

    private $vendorId;
    private $itemId;
    private $price;
    private $total;
    private $payment;
    private $address;
    private $city;
    private $state;
    private $phone;


    public function __construct(
        array $vendorId,
        array $itemId,
        array $price,
        int $total,
        string $payment,
        string $address,
        string $city,
        int $state,
        string $phone

    )
    {
        $this->vendorId = $vendorId;
        $this->itemId = $itemId;
        $this->price = $price;
        $this->total = $total;
        $this->payment = $payment;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->phone = $phone;


    }

    public static function fromRequest(OrderRequest $request): self
    {
        return new static(
            $request->vendorId(),
            $request->itemId(),
            $request->price(),
            $request->total(),
            $request->payment(),
            $request->address(),
            $request->city(),
            $request->state(),
            $request->phone(),

        );
    }

    public function handle(): Order
    {
            $status = Status::whereName('Pending')->first();
            $tracker = OrderTracker::whereName('Order Processed')->first();

            $order = new Order;
            $order->total = $this->total;
            $order->payment = $this->payment;
            SaveCodeService::IDGenerator(new Order, $order, 'code', 4, 'ORD');

            event(new OrderWasChannelled($order));

            $billingAddress = new BillingAddress;
            $billingAddress->order_id = $order->id();
            $billingAddress->address = $this->address;
            $billingAddress->city = $this->city;
            $billingAddress->state()->associate($this->state);
            $billingAddress->phone = $this->phone;
            $billingAddress->save();

            for ($vendor_id = 0; $vendor_id < count($this->vendorId); $vendor_id++) {

                $detail = OrderDetail::create([
                    'order_id'            =>  $order->id,
                    'vendor_id'            => $this->vendorId[$vendor_id],
                    'product_id'               => $this->itemId[$vendor_id],
                    'price'                => $this->price[$vendor_id],
                    'status_id'             => $status->id(),
                    'order_tracker_id'      => $tracker->id(),
                ]);

                // event(new OrderWasCreated($detail));
            }

            Cart::clear();
            return $order;
    }
}
