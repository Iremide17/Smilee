<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Agent;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Property;
use App\Models\Furniture;
use App\Events\AgentBanned;
use App\Events\PaymentWasMade;
use App\Observers\TagObserver;
use App\Events\OrderWasCreated;
use App\Observers\PostObserver;
use App\Observers\UserObserver;
use App\Events\ThreadWasCreated;
use App\Observers\AgentObserver;
use App\Observers\OrderObserver;
use App\Events\BookingWasCreated;
use App\Events\GalleryWasCreated;
use App\Events\ProductWasCreated;
use App\Observers\VendorObserver;
use App\Events\BookingWasAccepted;
use App\Events\BookingWasRejected;
use App\Events\BookingWasVerified;
use App\Events\OrderWasChannelled;
use App\Observers\GalleryObserver;
use App\Observers\ProductObserver;
use App\Observers\PropertyObserver;
use App\Observers\FurnitureObserver;
use Illuminate\Support\Facades\Event;
use App\Events\ApplicationWasAccepted;
use App\Events\ApplicationWasRejected;
use Illuminate\Auth\Events\Registered;
use App\Listeners\AwardPointsForBooking;
use App\Listeners\SendNewAgentNotification;
use App\Listeners\SendNewOrderNotification;
use App\Listeners\AwardPointsForMakingOrder;
use App\Listeners\sendNewThreadNotification;
use App\Listeners\SendNewBookingNotification;
use App\Listeners\sendNewGalleryNotification;
use App\Listeners\SendNewPaymentNotification;
use App\Listeners\sendNewProductNotification;
use App\Listeners\SendAgentBannedNotification;
use App\Listeners\AwardPointsForCreatingThread;
use App\Listeners\AwardPointsForCreatingGallery;
use App\Listeners\AwardPointsForCreatingProduct;
use App\Listeners\AwardPointsForAcceptingBooking;
use App\Listeners\SendAgentAccepttedNotification;
use App\Listeners\SendAgentRejecttedNotification;
use App\Listeners\SendNewAcceptBookingNotification;
use App\Listeners\SendNewRejectedBookingNotification;
use App\Listeners\SendNewVerifiedBookingNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // CommentWasCreated::class => [
        //     SendNewCommentNotification::class,
        //     AwardPointsForCreatingComment::class,
        // ],
        ThreadWasCreated::class => [
            sendNewThreadNotification::class,
            AwardPointsForCreatingThread::class,
        ],
        ProductWasCreated::class => [
            AwardPointsForCreatingProduct::class,
            sendNewProductNotification::class,
        ],
        GalleryWasCreated::class => [
            sendNewGalleryNotification::class,
            AwardPointsForCreatingGallery::class,
        ],
        OrderWasChannelled::class => [
            AwardPointsForMakingOrder::class,
        ],
        OrderWasCreated::class => [
            SendNewOrderNotification::class,
        ],
        PaymentWasMade::class => [
            SendNewPaymentNotification::class,
        ],
        BookingWasCreated::class => [
            AwardPointsForBooking::class,
            SendNewBookingNotification::class,
        ],
        BookingWasAccepted::class => [
            SendNewAcceptBookingNotification::class,
        ],
        BookingWasRejected::class => [
            SendNewRejectedBookingNotification::class,
        ],
        BookingWasVerified::class => [
            AwardPointsForAcceptingBooking::class,
            SendNewVerifiedBookingNotification::class,
        ],
        AgentWasCreated::class => [
            SendNewAgentNotification::class,
        ],
        ApplicationWasAccepted::class => [
            SendAgentAccepttedNotification::class,
        ],
        ApplicationWasRejected::class => [
            SendAgentRejecttedNotification::class,
        ],
        AgentBanned::class => [
            SendAgentBannedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Agent::observe(AgentObserver::class);
        Vendor::observe(VendorObserver::class);
        Tag::observe(TagObserver::class);
        Post::observe(PostObserver::class);
        Product::observe(ProductObserver::class);
        Gallery::observe(GalleryObserver::class);
        Property::observe(PropertyObserver::class);
        Order::observe(OrderObserver::class);
        Furniture::observe(FurnitureObserver::class);
    }
}
