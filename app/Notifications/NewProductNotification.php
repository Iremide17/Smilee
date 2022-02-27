<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Product;
use App\Mail\NewProductEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
    use Queueable;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail(User $user)
    {
        return (new NewProductEmail($this->product))
            ->to($user->emailAddress(), $user->name());
    }
}
