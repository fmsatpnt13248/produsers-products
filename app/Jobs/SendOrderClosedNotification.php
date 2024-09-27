<?php

namespace App\Jobs;

use App\Notifications\OrderStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOrderClosedNotification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $users;
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct($order, $users)
    {
        $this->order = $order;
        $this->users = $users;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->order->user->notify(new OrderStatusChanged($this->order, $this->users));
    }

    public function failed(Exception $exception)
    {
        $this->info('Job failed: ' . $exception->getMessage());
    }
}
