<?php

namespace App\Jobs;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExpiredOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * @var
     */
    protected $code;

    /**
     * Create a new job instance.
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $exists = Order::where('code', $this->code)
            ->where('status', Order::PAYMENT_PENDING)
            ->exists();
        
        if ($exists) {
            Order::where('code', $this->code)
                ->update([
                    'status' => Order::PAYMENT_EXPIRED,
                    'expired_at' => Carbon::now()
                ]);
        }
    }
}
