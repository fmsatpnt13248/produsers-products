<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;
    protected $closedOrders;

    /**
     * Create a new notification instance.
     */
    public function __construct($closedOrders)
    {
        $this->closedOrders = $closedOrders;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function viaQueues()
    {
        return [
            'mail' => 'emails',
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('Your' . count($this->closedOrders) . ' pending orders older than 30 days have been closed.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
//    public function toDatabase(object $notifiable): array
//    {
//        return [
//            'message' => count($this->closedOrders) . ' pending orders older than 30 days have been closed.',
//            'closed_orders_count' => count($this->closedOrders),
//            'time' => now(),
//        ];
//    }
}
