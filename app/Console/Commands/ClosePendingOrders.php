<?php

namespace App\Console\Commands;

use App\Jobs\SendOrderClosedNotification;
use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusChanged;

class ClosePendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:close-pending-orders {days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closing every x days old order with "pending" status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->argument('days');
        if ($days === null) {
            $this->fail('You didn\'t specify a day amount');
        } elseif ($days <= 0) {
            $this->fail('Days specified must be greater than 0');
        }

        $orders = Order::where('status', '1')->where('created_at', '<=', Carbon::now($days)->subDays())->get();
        $users = [];

        if ($orders->isNotEmpty()) {
            foreach ($orders as $order) {
                $order->status = '0';
                $order->save();
                $userId = $order->user_id;

                if (!isset($users[$userId])) {
                    $users[$userId] = 1;
                } else {
                    $users[$userId]++;
                }
            }
            foreach ($orders as $order) {
                SendOrderClosedNotification::dispatch($order, $users);
            }
        }
    }
}
