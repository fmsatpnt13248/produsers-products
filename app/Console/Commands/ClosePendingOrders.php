<?php

namespace App\Console\Commands;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->argument('days');
        if ($days == null) {
            $this->fail('You didn\'t specify a day amount');
        } elseif ($days <= 0) {
            $this->fail('Days specified must be greater than 0');
        }

        $orders = Order::where('status', 'pending')->where('created_at', '<=', Carbon::now($days)->subDays())->get();

        foreach ($orders as $order) {
            $order->status = 'cancelled';
            $order->save();
        }
        if ($orders->isNotEmpty()) {
            Notification::send(User::all(), new OrderStatusChanged($orders));
        }
    }
}
