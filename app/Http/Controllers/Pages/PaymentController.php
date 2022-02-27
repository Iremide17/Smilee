<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;
use App\Models\Order;
use App\Models\Status;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Events\PaymentWasMade;
use App\Events\OrderWasCreated;
use App\Events\OrderWasChannelled;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Services\SaveCodeService;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function __autoloadconstruct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        // dd($paymentDetails);

        $user = User::findOrFail($paymentDetails['data']['metadata']['user_id']);
        
        $payment = new Payment();
        $payment->email=$paymentDetails['data']['customer']['email'];
        $payment->status=$paymentDetails['data']['status'];
        $payment->amount=$paymentDetails['data']['amount'];
        $payment->trans_id=$paymentDetails['data']['id'];
        $payment->ref_id=$paymentDetails['data']['reference'];
        $payment->payment_type = $paymentDetails['data']['metadata']['paymentable_type'];
        $payment->authoredBy($user);
        $payment->save();
        
        if($payment->save())
        {
            if ($payment->payment_type == 'bookings')
            {
               $booking = Booking::where('id', $paymentDetails['data']['metadata']['booking']['id'])->first();
               $booking->update(['status_id' => 4]);
               $notification = array(
                'messege'     => 'Booking verified successfully',
                'alert-type'    => 'alert'
               );
               return redirect()->back()->with($notification);
            }
            elseif($payment->payment_type == 'products')
            {
                $status = Status::whereName('Pending')->first();

                // order modal
                $order = new Order;
                $order->authoredBy($user);
                $order->status()->associate($status);
                $order->total = $payment->amount;
                $order->payment = $paymentDetails['data']['metadata']['payment_type'];
                SaveCodeService::IDGenerator(new Order, $order, 'code', 4, 'ORD');


                // order details
                for ($product_id = 0; $product_id < count($paymentDetails['data']['metadata']['cartItems']); $product_id++) {

                    $product = Product::where('id',$paymentDetails['data']['metadata']['cartItems'][$product_id]['id'])->first();

                    $vendor_id = $product->vendor->id();

                    $detail = OrderDetail::create([
                        'order_id'            =>  $order->id,
                        'vendor_id'            => $vendor_id,
                        'product_id'           => $paymentDetails['data']['metadata']['cartItems'][$product_id]['id'],
                        'price'                => $paymentDetails['data']['metadata']['cartItems'][$product_id]['price'],
                    ]);
                    
                    event(new OrderWasCreated($detail));
                }

                Cart::clear(); 
                event(new OrderWasChannelled($order));
                event(new PaymentWasMade($payment));


                $notification = array(
                    'messege'     => 'Transaction was Successful',
                    'alert-type'    => 'success'
                );
                return redirect()->back()->with($notification);
            }
        }
        $notification = array(
            'messege'     => 'Transaction not Successful',
            'alert-type'    => 'alert'
        );
        return redirect()->back()->with($notification);
    }
}
